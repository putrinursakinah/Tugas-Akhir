<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataAnggaranRequest extends FormRequest
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
        return

            [
                'akun_id' => 'required|exists:kode_akun,id_akun',
                'kegiatan_id' => 'required|exists:kode_kegiatan,id_kegiatan',
                'komponen_kode' => 'required|string|max:50',


            ];
    }
}
