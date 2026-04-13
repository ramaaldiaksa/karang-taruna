<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SuratRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'jenis_surat' => 'required|in:surat masuk,surat keluar',
            'tanggal_upload' => 'required|date',
            'file_surat' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ];
    }
}
