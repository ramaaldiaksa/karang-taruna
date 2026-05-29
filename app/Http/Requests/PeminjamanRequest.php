<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'id_inventaris' => 'required|array|min:1',
            'id_inventaris.*' => 'required|exists:inventaris,id_inventaris',
            'jumlah_pinjam' => 'required|array|min:1',
            'jumlah_pinjam.*' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'rencana_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ];
    }

    /**
     * Pastikan jumlah elemen id_inventaris dan jumlah_pinjam sama.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $ids = (array) $this->input('id_inventaris', []);
            $jumlah = (array) $this->input('jumlah_pinjam', []);

            if (count($ids) !== count($jumlah)) {
                $validator->errors()->add('jumlah_pinjam', 'Data barang dan jumlah pinjam tidak sesuai.');
            }
        });
    }
}
