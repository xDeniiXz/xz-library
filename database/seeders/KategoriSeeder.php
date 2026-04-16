<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Fiksi',
            'Komik',
            'Legenda',
            'Sains',
            'Teknologi',
            'Sejarah',
            'Biografi',
            'Novel',
            'Majalah',
            'Ensiklopedia',
            'Pendidikan',
            'Agama',
            'Hukum',
            'Seni',
            'Kesehatan',
            'Sastra',
            'Filsafat',
            'Psikologi',
            'Ekonomi',
            'Politik',
            'Olahraga',
            'Kuliner',
            'Travel',
            'Hobi',
            'Pengembangan Diri',
        ];

        foreach ($kategori as $nama) {
            Kategori::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}
