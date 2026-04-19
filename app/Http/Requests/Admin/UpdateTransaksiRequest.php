<?php

namespace App\Http\Requests\Admin;

use App\Enums\PeminjamanStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTransaksiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => ['required', new Enum(PeminjamanStatus::class)],
            'catatan' => 'nullable|string|max:255',
            'tanggal_pengembalian' => 'required_if:status,dikembalikan|nullable|date|after_or_equal:tanggal_pinjam',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status transaksi harus dipilih.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
            'tanggal_pengembalian.required_if' => 'Tanggal pengembalian harus diisi jika status sudah dikembalikan.',
            'tanggal_pengembalian.after_or_equal' => 'Tanggal pengembalian tidak boleh sebelum tanggal pinjam.',
        ];
    }
}
