<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Enums\PeminjamanStatus;
use App\Enums\UserRole;
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
            'total_siswa' => User::where('role', UserRole::STUDENT)->count(),
            'sedang_dipinjam' => Peminjaman::where('status', PeminjamanStatus::DIPINJAM)->count(),
            'permintaan_menunggu' => Peminjaman::whereIn('status', [PeminjamanStatus::MENUNGGU, PeminjamanStatus::MENUNGGU_PENGEMBALIAN])->count(),
            'terlambat' => Peminjaman::where('status', PeminjamanStatus::DIPINJAM)
                ->where('tanggal_kembali', '<', Carbon::today())
                ->count(),
            'total_denda' => Pengembalian::sum('denda'),
        ];

        $transaksi_terbaru = Peminjaman::with(['user', 'buku'])
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'transaksi_terbaru'));
    }

    private function studentDashboard()
    {
        $user_id = Auth::id();

        $stats = [
            'buku_dipinjam' => Peminjaman::where('user_id', $user_id)
                ->where('status', PeminjamanStatus::DIPINJAM)
                ->count(),
            'permintaan_menunggu' => Peminjaman::where('user_id', $user_id)
                ->whereIn('status', [PeminjamanStatus::MENUNGGU, PeminjamanStatus::MENUNGGU_PENGEMBALIAN])
                ->count(),
            'total_pinjam' => Peminjaman::where('user_id', $user_id)->count(),
            'total_denda' => Pengembalian::whereHas('peminjaman', function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            })->sum('denda'),
            'jatuh_tempo' => Peminjaman::where('user_id', $user_id)
                ->where('status', PeminjamanStatus::DIPINJAM)
                ->orderBy('tanggal_kembali', 'asc')
                ->first(),
        ];

        $riwayat_terbaru = Peminjaman::with(['buku', 'pengembalian'])
            ->where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'riwayat_terbaru'));
    }
}
