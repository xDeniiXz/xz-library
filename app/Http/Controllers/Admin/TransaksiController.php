<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use App\Enums\PeminjamanStatus;
use App\Http\Requests\Admin\StoreTransaksiRequest;
use App\Http\Requests\Admin\UpdateTransaksiRequest;
use App\Services\LibraryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    protected $libraryService;

    public function __construct(LibraryService $libraryService)
    {
        $this->libraryService = $libraryService;
    }

    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'buku', 'pengembalian']);

        if ($request->filled('search')) {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'peminjam');

            $query->where(function ($q) use ($search, $criteria) {
                if ($criteria === 'peminjam') {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%$search%");
                    });
                } elseif ($criteria === 'username') {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('username', 'like', "%$search%");
                    });
                } elseif ($criteria === 'buku') {
                    $q->whereHas('buku', function ($bookQuery) use ($search) {
                        $bookQuery->where('judul', 'like', "%$search%");
                    });
                } else {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%$search%")
                            ->orWhere('username', 'like', "%$search%");
                    })->orWhereHas('buku', function ($bookQuery) use ($search) {
                        $bookQuery->where('judul', 'like', "%$search%");
                    });
                }
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'id');

        // Sorting logic for relations
        if ($criteria === 'peminjam') {
            $query = $query->select('peminjaman.*')
                ->join('users', 'peminjaman.user_id', '=', 'users.id')
                ->orderBy('users.name', $sort);
        } elseif ($criteria === 'username') {
            $query = $query->select('peminjaman.*')
                ->join('users', 'peminjaman.user_id', '=', 'users.id')
                ->orderBy('users.username', $sort);
        } elseif ($criteria === 'buku') {
            $query = $query->select('peminjaman.*')
                ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                ->orderBy('buku.judul', $sort);
        } else {
            $query = $query->orderBy('peminjaman.id', $sort);
        }

        $transaksi = $query->paginate(10)->appends(request()->query());
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $anggota = User::where('role', 'student')->get();
        $buku = Buku::where('stok', '>', 0)->get();
        return view('admin.transaksi.create', compact('anggota', 'buku'));
    }

    public function store(StoreTransaksiRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $buku = Buku::findOrFail($request->buku_id);
            if ($buku->stok <= 0) {
                return back()->withErrors(['buku_id' => 'Stok buku habis.'])->withInput();
            }

            Peminjaman::create([
                'user_id' => $request->user_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => PeminjamanStatus::DIPINJAM,
            ]);

            $buku->decrement('stok');

            return redirect()->route('admin.transaksi.index')->with('success', 'Peminjaman berhasil dicatat.');
        });
    }

    public function edit(Peminjaman $peminjaman)
    {
        $anggota = User::where('role', 'student')->get();
        $buku = Buku::orderBy('judul', 'asc')->get();
        return view('admin.transaksi.edit', compact('peminjaman', 'anggota', 'buku'));
    }

    public function update(UpdateTransaksiRequest $request, Peminjaman $peminjaman)
    {
        return DB::transaction(function () use ($request, $peminjaman) {
            try {
                $this->libraryService->processStockChange($peminjaman, $request->status, $request->buku_id);
            } catch (\Exception $e) {
                return back()->withErrors(['buku_id' => $e->getMessage()])->withInput();
            }

            $peminjaman->update($request->validated());

            return redirect()->route('admin.transaksi.index')->with('success', 'Data transaksi berhasil diperbarui.');
        });
    }

    public function approve(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== PeminjamanStatus::MENUNGGU) {
            return back()->with('error', 'Transaksi ini tidak dapat disetujui.');
        }

        return DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->buku->stok <= 0) {
                return back()->with('error', 'Stok buku habis. Permintaan tidak dapat disetujui.');
            }

            $peminjaman->update(['status' => PeminjamanStatus::DIPINJAM]);
            $peminjaman->buku->decrement('stok');

            return back()->with('success', 'Permintaan peminjaman berhasil disetujui.');
        });
    }

    public function reject(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== PeminjamanStatus::MENUNGGU) {
            return back()->with('error', 'Transaksi ini tidak dapat ditolak.');
        }

        $peminjaman->update(['status' => PeminjamanStatus::DITOLAK]);

        return back()->with('success', 'Permintaan peminjaman telah ditolak.');
    }

    public function kembalikan(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status === PeminjamanStatus::DIKEMBALIKAN) {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $request->validate([
            'tanggal_pengembalian' => 'required|date|after_or_equal:' . $peminjaman->tanggal_pinjam,
        ]);

        return DB::transaction(function () use ($request, $peminjaman) {
            $denda = $this->libraryService->calculateFines($peminjaman, $request->tanggal_pengembalian);

            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'denda' => $denda,
            ]);

            $peminjaman->update(['status' => PeminjamanStatus::DIKEMBALIKAN]);
            $peminjaman->buku->increment('stok');

            $pesan = 'Buku berhasil dikembalikan.';
            if ($denda > 0) {
                $pesan .= ' Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.');
            }

            return redirect()->route('admin.transaksi.index')->with('success', $pesan);
        });
    }

    public function destroy(Peminjaman $peminjaman)
    {
        return DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status === PeminjamanStatus::DIPINJAM) {
                $peminjaman->buku->increment('stok');
            }

            $peminjaman->delete();
            return redirect()->route('admin.transaksi.index')->with('success', 'Data transaksi berhasil dihapus.');
        });
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!$ids) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        return DB::transaction(function () use ($ids) {
            $peminjamans = Peminjaman::whereIn('id', $ids)->get();
            foreach ($peminjamans as $peminjaman) {
                if ($peminjaman->status === PeminjamanStatus::DIPINJAM) {
                    $peminjaman->buku->increment('stok');
                }
                $peminjaman->delete();
            }

            return response()->json(['success' => true, 'message' => 'Transaksi yang dipilih berhasil dihapus.']);
        });
    }

    public function export(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids && is_string($ids)) {
            $ids = explode(',', $ids);
        }
        return Excel::download(new TransaksiExport($ids), 'data_transaksi_' . date('Ymd_His') . '.xlsx');
    }
}
