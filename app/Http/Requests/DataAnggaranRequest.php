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
                'kegiatan_id' => 'required|exists:kode_kegiatan,id_kegiatan',
                'komponen_kode' => 'required|string|max:50',
                'komponen_uraian' => 'required|string|max:255',
                'akun_id' => 'required|exists:kode_akun,id_akun',

                'detail_uraian' => 'required|string|max:255',
                'detail_vol' => 'required|numeric|min:1',
                'detail_satuan' => 'nullable|string|max:20',
                'detail_harga_satuan' => 'required|numeric|min:1',
                'detail_jumlah' => 'required|numeric|min:1',
            ];
    }
}
