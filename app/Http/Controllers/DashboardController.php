<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->studentDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_buku' => Buku::count(),
            'total_siswa' => User::where('role', 'student')->count(),
            'sedang_dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'permintaan_menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'terlambat' => Peminjaman::where('status', 'dipinjam')
                ->where('tanggal_kembali', '<', Carbon::today())
                ->count(),
            'total_denda' => Pengembalian::sum('denda'),
        ];

        $transaksi_terbaru = Peminjaman::with(['user', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'transaksi_terbaru'));
    }

    private function studentDashboard()
    {
        $user_id = Auth::id();

        $stats = [
            'buku_dipinjam' => Peminjaman::where('user_id', $user_id)
                ->where('status', 'dipinjam')
                ->count(),
            'permintaan_menunggu' => Peminjaman::where('user_id', $user_id)
                ->where('status', 'menunggu')
                ->count(),
            'total_pinjam' => Peminjaman::where('user_id', $user_id)->count(),
            'total_denda' => Pengembalian::whereHas('peminjaman', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })->sum('denda'),
            'jatuh_tempo' => Peminjaman::where('user_id', $user_id)
                ->where('status', 'dipinjam')
                ->orderBy('tanggal_kembali', 'asc')
                ->first(),
        ];

        $riwayat_terbaru = Peminjaman::with(['buku', 'pengembalian'])
            ->where('user_id', $user_id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'riwayat_terbaru'));
    }
}
