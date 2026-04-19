<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Enums\PeminjamanStatus;
use App\Http\Requests\Admin\StoreTransaksiRequest;
use App\Http\Requests\Admin\UpdateTransaksiRequest;
use App\Services\LibraryService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    protected $libraryService;

    public function __construct(LibraryService $libraryService)
    {
        $this->libraryService = $libraryService;
    }

    public function index(Request $request)
    {
        $query = Peminjaman::with(['buku', 'pengembalian'])
            ->where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'judul');

            $query->whereHas('buku', function ($q) use ($search, $criteria) {
                if ($criteria === 'judul') {
                    $q->where('judul', 'like', "%$search%");
                } elseif ($criteria === 'penulis') {
                    $q->where('penulis', 'like', "%$search%");
                } elseif ($criteria === 'penerbit') {
                    $q->where('penerbit', 'like', "%$search%");
                } elseif ($criteria === 'tahun_terbit') {
                    $q->where('tahun_terbit', $search);
                } elseif ($criteria === 'isbn') {
                    $q->where('isbn', 'like', "%$search%");
                } else {
                    $q->where('judul', 'like', "%$search%")
                        ->orWhere('penulis', 'like', "%$search%")
                        ->orWhere('penerbit', 'like', "%$search%")
                        ->orWhere('isbn', 'like', "%$search%");
                }
            });
        }

        if ($request->filled('status')) {
            $query->where('peminjaman.status', $request->get('status'));
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'id');

        $allowedBukuSort = ['judul', 'penulis', 'penerbit', 'tahun_terbit'];

        if (in_array($criteria, $allowedBukuSort)) {
            $query = $query->select('peminjaman.*')
                ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                ->orderBy('buku.' . $criteria, $sort);
        } else {
            $query = $query->orderBy('peminjaman.id', $sort);
        }

        $peminjaman = $query->paginate(10)->appends(request()->query());
        return view('student.peminjaman.index', compact('peminjaman'));
    }

    public function katalog(Request $request)
    {
        $query = Buku::with('kategori');

        // Filter by Criteria and Search
        if ($request->has('search') && $request->get('search') != '') {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'judul');

            $query->where(function ($q) use ($search, $criteria) {
                if ($criteria === 'judul') {
                    $q->where('judul', 'like', "%$search%");
                } elseif ($criteria === 'penulis') {
                    $q->where('penulis', 'like', "%$search%");
                } elseif ($criteria === 'penerbit') {
                    $q->where('penerbit', 'like', "%$search%");
                } elseif ($criteria === 'tahun_terbit') {
                    $q->where('tahun_terbit', $search);
                } else {
                    // Default: 'semua'
                    $q->where('judul', 'like', "%$search%")
                        ->orWhere('penulis', 'like', "%$search%")
                        ->orWhere('penerbit', 'like', "%$search%")
                        ->orWhere('isbn', 'like', "%$search%");
                }
            });
        }

        // Category Filter (Keep as separate dropdown as it's a relationship)
        if ($request->has('kategori_id') && $request->get('kategori_id') != '') {
            $query->where('kategori_id', $request->get('kategori_id'));
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'judul');
        $allowedSortColumns = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'id'];
        $sortColumn = in_array($criteria, $allowedSortColumns) ? $criteria : 'judul';

        $buku = $query->orderBy($sortColumn, $sort)->paginate(10)->appends(request()->query());
        $kategori = \App\Models\Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('student.peminjaman.katalog', compact('buku', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        if (!$this->libraryService->canBorrow(Auth::id())) {
            return back()->with('error', 'Anda sudah mencapai batas maksimal peminjaman (3 buku). Silakan kembalikan buku terlebih dahulu.');
        }

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku ini sedang habis.');
        }

        // Cek apakah siswa masih meminjam buku ini atau sudah ada request yang sedang menunggu
        $cekPinjam = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->whereIn('status', [PeminjamanStatus::DIPINJAM, PeminjamanStatus::MENUNGGU, PeminjamanStatus::MENUNGGU_PENGEMBALIAN])
            ->first();

        if ($cekPinjam) {
            if ($cekPinjam->status === PeminjamanStatus::DIPINJAM) {
                return back()->with('error', 'Anda masih meminjam buku ini.');
            } elseif ($cekPinjam->status === PeminjamanStatus::MENUNGGU_PENGEMBALIAN) {
                return back()->with('error', 'Buku ini sedang dalam proses pengembalian.');
            } else {
                return back()->with('error', 'Permintaan peminjaman buku ini sudah dikirim dan sedang menunggu persetujuan admin.');
            }
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => Carbon::now()->toDateString(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => PeminjamanStatus::MENUNGGU,
        ]);

        return back()->with('success', 'Permintaan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function kembalikan(Request $request, Peminjaman $peminjaman)
    {
        // Pastikan peminjaman ini milik user yang sedang login
        if ($peminjaman->user_id !== Auth::id()) {
            abort(403);
        }

        if ($peminjaman->status === PeminjamanStatus::DIKEMBALIKAN) {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        if ($peminjaman->status === PeminjamanStatus::MENUNGGU_PENGEMBALIAN) {
            return back()->with('error', 'Permintaan pengembalian sedang menunggu persetujuan admin.');
        }

        if ($peminjaman->status !== PeminjamanStatus::DIPINJAM) {
            return back()->with('error', 'Buku belum disetujui untuk dipinjam atau status tidak valid.');
        }

        $estimasi_denda = $this->libraryService->calculateFines($peminjaman, Carbon::now()->toDateString());

        $peminjaman->update([
            'status' => PeminjamanStatus::MENUNGGU_PENGEMBALIAN,
            'estimasi_denda' => $estimasi_denda,
        ]);

        $pesan = 'Permintaan pengembalian telah dikirim. Silakan serahkan buku ke perpustakaan untuk konfirmasi.';
        $pesan .= ' Estimasi denda saat ini: Rp ' . number_format($estimasi_denda, 0, ',', '.');

        return redirect()->route('student.peminjaman.index')->with('success', $pesan);
    }
}
