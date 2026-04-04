<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Student User',
            'username' => 'student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        $kategori = \App\Models\Kategori::create([
            'nama_kategori' => 'Fiksi',
        ]);

        \App\Models\Buku::create([
            'judul' => 'Buku Contoh',
            'penulis' => 'Nama Penulis',
            'penerbit' => 'Nama Penerbit',
            'tahun_terbit' => 2023,
            'isbn' => '1234567890',
            'stok' => 10,
            'kategori_id' => $kategori->id,
        ]);
    }
}
