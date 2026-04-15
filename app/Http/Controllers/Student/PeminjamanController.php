<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['buku', 'pengembalian'])
            ->where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'semua');

            $query->whereHas('buku', function ($q) use ($search, $criteria) {
                if ($criteria === 'judul') {
                    $q->where('judul', 'like', "%$search%");
                } elseif ($criteria === 'penulis') {
                    $q->where('penulis', 'like', "%$search%");
                } elseif ($criteria === 'penerbit') {
                    $q->where('penerbit', 'like', "%$search%");
                } elseif ($criteria === 'tahun_terbit') {
                    $q->where('tahun_terbit', $search);
                } else {
                    $q->where('judul', 'like', "%$search%")
                        ->orWhere('penulis', 'like', "%$search%")
                        ->orWhere('penerbit', 'like', "%$search%")
                        ->orWhere('isbn', 'like', "%$search%");
                }
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'id');

        $allowedBukuSort = ['judul', 'penulis', 'penerbit', 'tahun_terbit'];

        if (in_array($criteria, $allowedBukuSort)) {
            $query->select('peminjaman.*')
                ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                ->orderBy('buku.' . $criteria, $sort);
        } else {
            $query->orderBy('peminjaman.id', $sort);
        }

        $peminjaman = $query->get();
        return view('student.peminjaman.index', compact('peminjaman'));
    }

    public function katalog(Request $request)
    {
        $query = Buku::with('kategori');

        // Filter by Criteria and Search
        if ($request->has('search') && $request->get('search') != '') {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'semua');

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

        $buku = $query->orderBy('judul', 'asc')->get();
        $kategori = \App\Models\Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('student.peminjaman.katalog', compact('buku', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku ini sedang habis.');
        }

        // Cek apakah siswa masih meminjam buku ini atau sudah ada request yang sedang menunggu
        $cekPinjam = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->whereIn('status', ['dipinjam', 'menunggu'])
            ->first();

        if ($cekPinjam) {
            if ($cekPinjam->status === 'dipinjam') {
                return back()->with('error', 'Anda masih meminjam buku ini.');
            } else {
                return back()->with('error', 'Permintaan peminjaman buku ini sudah dikirim dan sedang menunggu persetujuan admin.');
            }
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => Carbon::now()->toDateString(),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu',
        ]);

        return redirect()->route('student.peminjaman.index')->with('success', 'Permintaan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function kembalikan(Request $request, Peminjaman $peminjaman)
    {
        // Pastikan peminjaman ini milik user yang sedang login
        if ($peminjaman->user_id !== Auth::id()) {
            abort(403);
        }

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Buku belum disetujui untuk dipinjam atau status tidak valid.');
        }

        $tanggal_pengembalian = Carbon::now();
        $due_date = Carbon::parse($peminjaman->tanggal_kembali);
        $denda = 0;

        // Hitung denda jika terlambat (10.000 per hari)
        if ($tanggal_pengembalian->gt($due_date)) {
            $days = $tanggal_pengembalian->diffInDays($due_date);
            $denda = $days * 10000;
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

        return redirect()->route('student.peminjaman.index')->with('success', $pesan);
    }
}
