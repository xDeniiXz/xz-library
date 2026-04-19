<?php

namespace App\Services;

use App\Enums\PeminjamanStatus;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LibraryService
{
    public function calculateFines(Peminjaman $peminjaman, string $tanggal_pengembalian): int
    {
        $returnDate = Carbon::parse($tanggal_pengembalian);
        $dueDate = Carbon::parse($peminjaman->tanggal_kembali);
        
        if ($returnDate->gt($dueDate)) {
            return $returnDate->diffInDays($dueDate) * 10000;
        }

        return 0;
    }

    public function canBorrow(int $userId): bool
    {
        $activeLoansCount = Peminjaman::where('user_id', $userId)
            ->whereIn('status', [
                PeminjamanStatus::DIPINJAM,
                PeminjamanStatus::MENUNGGU,
                PeminjamanStatus::MENUNGGU_PENGEMBALIAN
            ])
            ->count();

        return $activeLoansCount < 3;
    }

    public function processStockChange(Peminjaman $peminjaman, string $newStatus, ?int $newBukuId = null): void
    {
        $currentStatus = $peminjaman->status;
        $currentBuku = $peminjaman->buku;

        // Handle Book Change
        if ($newBukuId && $peminjaman->buku_id != $newBukuId) {
            if ($currentStatus === PeminjamanStatus::DIPINJAM->value) {
                $currentBuku->increment('stok');
            }
            
            if ($newStatus === PeminjamanStatus::DIPINJAM->value) {
                $newBuku = Buku::findOrFail($newBukuId);
                if ($newBuku->stok <= 0) {
                    throw new \Exception('Stok buku baru habis.');
                }
                $newBuku->decrement('stok');
            }
        } else {
            // Same Book, Status Change
            if ($currentStatus !== PeminjamanStatus::DIPINJAM->value && $newStatus === PeminjamanStatus::DIPINJAM->value) {
                if ($currentBuku->stok <= 0) {
                    throw new \Exception('Stok buku habis.');
                }
                $currentBuku->decrement('stok');
            } elseif ($currentStatus === PeminjamanStatus::DIPINJAM->value && $newStatus !== PeminjamanStatus::DIPINJAM->value) {
                $currentBuku->increment('stok');
            }
        }
    }
}
