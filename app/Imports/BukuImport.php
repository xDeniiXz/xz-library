<?php

namespace App\Imports;

use App\Models\Buku;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari kategori berdasarkan nama, jika tidak ada buat baru atau abaikan
        $kategori = Kategori::firstOrCreate(['nama_kategori' => $row['kategori'] ?? 'Lainnya']);

        return new Buku([
            'judul'        => $row['judul'],
            'penulis'      => $row['penulis'],
            'penerbit'     => $row['penerbit'],
            'tahun_terbit' => $row['tahun_terbit'],
            'isbn'         => $row['isbn'],
            'stok'         => $row['stok'],
            'kategori_id'  => $kategori->id,
        ]);
    }
}
