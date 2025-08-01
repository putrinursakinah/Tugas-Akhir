<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanKomponenSementaraRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode' => 'required',
            'uraian' => 'required',
            'kegiatan_id' => 'required|exists:kode_kegiatan,id_kegiatan',
        ];
    }
    public function messages(): array
    {
        return [
            'kode.required' => 'Kode komponen wajib diisi.',
            'uraian.required' => 'Uraian komponen wajib diisi.',
            'kegiatan_id.required' => 'Kegiatan belum dipilih.',
            'kegiatan_id.exists' => 'Kegiatan tidak ditemukan.',
        ];
    }
}
