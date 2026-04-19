<?php

namespace App\Enums;

enum PeminjamanStatus: string
{
    case MENUNGGU = 'menunggu';
    case DIPINJAM = 'dipinjam';
    case MENUNGGU_PENGEMBALIAN = 'menunggu_pengembalian';
    case DIKEMBALIKAN = 'dikembalikan';
    case DITOLAK = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::MENUNGGU => 'Menunggu Persetujuan',
            self::DIPINJAM => 'Sedang Dipinjam',
            self::MENUNGGU_PENGEMBALIAN => 'Menunggu Konfirmasi Kembali',
            self::DIKEMBALIKAN => 'Sudah Dikembalikan',
            self::DITOLAK => 'Permintaan Ditolak',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::MENUNGGU => 'amber',
            self::DIPINJAM => 'blue',
            self::MENUNGGU_PENGEMBALIAN => 'indigo',
            self::DIKEMBALIKAN => 'green',
            self::DITOLAK => 'rose',
        };
    }
}
