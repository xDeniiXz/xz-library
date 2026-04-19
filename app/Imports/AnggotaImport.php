<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'         => $row['nama_lengkap'],
            'username'     => $row['username'],
            'email'        => $row['email'],
            'password'     => Hash::make($row['password'] ?? 'password123'),
            'address'      => $row['alamat'],
            'phone_number' => $row['nomor_telepon'],
            'role'         => 'student',
        ]);
    }
}
