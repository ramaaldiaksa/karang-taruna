<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InventarisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_barang'     => 'required|string|max:255',
            'tanggal_masuk'   => 'required|date',
            'jumlah_total'    => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_barang.required'   => 'Nama barang wajib diisi.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
            'jumlah_total.required'  => 'Jumlah barang wajib diisi.',
            'jumlah_total.min'       => 'Jumlah barang minimal 1.',
        ];
    }
}

