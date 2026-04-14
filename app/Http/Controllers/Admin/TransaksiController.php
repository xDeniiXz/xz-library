<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'buku', 'pengembalian']);

        if ($request->filled('search')) {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'semua');

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

        $transaksi = $query->orderBy('tanggal_pinjam', 'desc')->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $anggota = User::where('role', 'student')->get();
        $buku = Buku::where('stok', '>', 0)->get();
        return view('admin.transaksi.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // Cek stok buku
        $buku = Buku::findOrFail($request->buku_id);
        if ($buku->stok <= 0) {
            return back()->withErrors(['buku_id' => 'Stok buku habis.'])->withInput();
        }

        Peminjaman::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $buku->decrement('stok');

        return redirect()->route('admin.transaksi.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function kembalikan(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $request->validate([
            'tanggal_pengembalian' => 'required|date|after_or_equal:' . $peminjaman->tanggal_pinjam,
        ]);

        $tanggal_pengembalian = Carbon::parse($request->tanggal_pengembalian);
        $due_date = Carbon::parse($peminjaman->tanggal_kembali);
        $denda = 0;

        // Hitung denda jika terlambat (misal 1000 per hari)
        if ($tanggal_pengembalian->gt($due_date)) {
            $days = $tanggal_pengembalian->diffInDays($due_date);
            $denda = $days * 1000;
        }

        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => $tanggal_pengembalian->toDateString(),
            'denda' => $denda,
        ]);

        $peminjaman->update(['status' => 'dikembalikan']);

        // Kembalikan stok buku
        $peminjaman->buku->increment('stok');

        $pesan = 'Buku berhasil dikembalikan.';
        if ($denda > 0) {
            $pesan .= ' Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->route('admin.transaksi.index')->with('success', $pesan);
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Jika dihapus saat status masih dipinjam, kembalikan stok
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'Data transaksi berhasil dihapus.');
    }
}
