<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $ids;

    public function __construct($ids = null)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        $query = User::where('role', 'student');

        if ($this->ids && count($this->ids) > 0) {
            $query->whereIn('id', $this->ids);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'Username',
            'Email',
            'Alamat',
            'Nomor Telepon',
            'Tanggal Bergabung',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->username,
            $user->email,
            $user->address ?? '-',
            $user->phone_number ?? '-',
            $user->created_at->format('d M Y'),
        ];
    }
}
