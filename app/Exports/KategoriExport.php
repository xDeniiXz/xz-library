<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KategoriExport implements FromCollection, WithHeadings, WithMapping
{
    protected $ids;

    public function __construct($ids = null)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        $query = Kategori::withCount('buku');

        if ($this->ids && count($this->ids) > 0) {
            $query->whereIn('id', $this->ids);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Kategori',
            'Jumlah Buku',
        ];
    }

    public function map($kategori): array
    {
        return [
            $kategori->id,
            $kategori->nama_kategori,
            $kategori->buku_count,
        ];
    }
}
