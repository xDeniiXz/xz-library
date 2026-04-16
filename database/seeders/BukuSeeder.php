<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2019,
                'isbn' => '9786020633176',
                'stok' => 15,
                'kategori' => 'Pengembangan Diri',
            ],
            [
                'judul' => 'The Psychology of Money',
                'penulis' => 'Morgan Housel',
                'penerbit' => 'Harriman House',
                'tahun_terbit' => 2020,
                'isbn' => '9781804090039',
                'stok' => 10,
                'kategori' => 'Ekonomi',
            ],
            [
                'judul' => 'It Ends with Us',
                'penulis' => 'Colleen Hoover',
                'penerbit' => 'Atria Books',
                'tahun_terbit' => 2016,
                'isbn' => '9781501110368',
                'stok' => 20,
                'kategori' => 'Novel',
            ],
            [
                'judul' => 'The Midnight Library',
                'penulis' => 'Matt Haig',
                'penerbit' => 'Canongate Books',
                'tahun_terbit' => 2020,
                'isbn' => '9781786892706',
                'stok' => 12,
                'kategori' => 'Fiksi',
            ],
            [
                'judul' => 'Almond',
                'penulis' => 'Won-pyung Sohn',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2017,
                'isbn' => '9786020633510',
                'stok' => 8,
                'kategori' => 'Sastra',
            ],
            [
                'judul' => 'Laut Bercerita',
                'penulis' => 'Leila S. Chudori',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => 2017,
                'isbn' => '9786024246938',
                'stok' => 25,
                'kategori' => 'Novel',
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Buku Kompas',
                'tahun_terbit' => 2018,
                'isbn' => '9786024125189',
                'stok' => 30,
                'kategori' => 'Filsafat',
            ],
            [
                'judul' => 'The Seven Husbands of Evelyn Hugo',
                'penulis' => 'Taylor Jenkins Reid',
                'penerbit' => 'Atria Books',
                'tahun_terbit' => 2017,
                'isbn' => '9781501139239',
                'stok' => 14,
                'kategori' => 'Fiksi',
            ],
            [
                'judul' => 'Rich Dad Poor Dad',
                'penulis' => 'Robert T. Kiyosaki',
                'penerbit' => 'Plata Publishing',
                'tahun_terbit' => 2017,
                'isbn' => '9781612680194',
                'stok' => 18,
                'kategori' => 'Ekonomi',
            ],
            [
                'judul' => 'Sapiens: A Brief History of Humankind',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Harper',
                'tahun_terbit' => 2014,
                'isbn' => '9780062316097',
                'stok' => 9,
                'kategori' => 'Sejarah',
            ],
            [
                'judul' => 'Bicara Itu Ada Seninya',
                'penulis' => 'Oh Su Hyang',
                'penerbit' => 'Bhuana Ilmu Populer',
                'tahun_terbit' => 2018,
                'isbn' => '9786024553920',
                'stok' => 22,
                'kategori' => 'Pengembangan Diri',
            ],
            [
                'judul' => 'Ikigai: The Japanese Secret to a Long and Happy Life',
                'penulis' => 'Héctor García',
                'penerbit' => 'Penguin Life',
                'tahun_terbit' => 2016,
                'isbn' => '9780143130727',
                'stok' => 16,
                'kategori' => 'Psikologi',
            ],
        ];

        foreach ($books as $bookData) {
            $kategoriNama = $bookData['kategori'];
            unset($bookData['kategori']);

            $kategori = Kategori::where('nama_kategori', $kategoriNama)->first();

            if ($kategori) {
                $bookData['kategori_id'] = $kategori->id;
                Buku::firstOrCreate(
                    ['isbn' => $bookData['isbn']],
                    $bookData
                );
            }
        }
    }
}
