<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataAnggaranRequest extends FormRequest
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
            'uraian_detail' => 'required|string|max:255',
            'vol' => 'required|numeric',
            'satuan' => 'nullable|string',
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ];
    }
}
