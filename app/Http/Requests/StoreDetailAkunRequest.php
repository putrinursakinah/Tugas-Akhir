<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailAkunRequest extends FormRequest
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
            'kode_detail' => 'required',
            'kode_urut' => 'required|numeric',
            'uraian_detail' => 'required|string',
            'vol' => 'nullable|numeric',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'nullable|numeric',
            'jumlah' => 'nullable|numeric',
        ];
    }
}
