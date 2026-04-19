<?php

namespace App\Enums;

enum PeminjamanStatus: string
{
    case MENUNGGU = 'menunggu';
    case DIPINJAM = 'dipinjam';
    case DIKEMBALIKAN = 'dikembalikan';
    case DITOLAK = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::MENUNGGU => 'Menunggu Persetujuan',
            self::DIPINJAM => 'Sedang Dipinjam',
            self::DIKEMBALIKAN => 'Sudah Dikembalikan',
            self::DITOLAK => 'Permintaan Ditolak',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::MENUNGGU => 'amber',
            self::DIPINJAM => 'rose',
            self::DIKEMBALIKAN => 'green',
            self::DITOLAK => 'gray',
        };
    }
}
