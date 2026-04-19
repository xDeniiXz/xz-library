<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $ids;

    public function __construct($ids = null)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        $query = Peminjaman::with(['user', 'buku', 'pengembalian']);

        if ($this->ids && count($this->ids) > 0) {
            $query->whereIn('id', $this->ids);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Peminjam',
            'Username',
            'Judul Buku',
            'Tgl Pinjam',
            'Batas Kembali',
            'Status',
            'Tgl Kembali',
            'Denda',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->user->name,
            $peminjaman->user->username,
            $peminjaman->buku->judul,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali,
            strtoupper($peminjaman->status),
            $peminjaman->pengembalian->tanggal_pengembalian ?? '-',
            $peminjaman->pengembalian->denda ?? 0,
        ];
    }
}
