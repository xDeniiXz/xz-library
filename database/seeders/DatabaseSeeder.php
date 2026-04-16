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
            'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            'phone_number' => '081234567890',
        ]);

        \App\Models\User::create([
            'name' => 'Student User',
            'username' => 'student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'address' => 'Jl. Pendidikan No. 45, Bandung',
            'phone_number' => '089876543210',
        ]);

        $this->call([
            KategoriSeeder::class,
            BukuSeeder::class,
        ]);
    }
}
