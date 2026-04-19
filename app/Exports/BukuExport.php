<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromCollection, WithHeadings, WithMapping
{
    protected $ids;

    public function __construct($ids = null)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        $query = Buku::with('kategori');

        if ($this->ids && count($this->ids) > 0) {
            $query->whereIn('id', $this->ids);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'ISBN',
            'Stok',
            'Kategori',
        ];
    }

    public function map($buku): array
    {
        return [
            $buku->id,
            $buku->judul,
            $buku->penulis,
            $buku->penerbit,
            $buku->tahun_terbit,
            $buku->isbn,
            $buku->stok,
            $buku->kategori->nama_kategori ?? '-',
        ];
    }
}
