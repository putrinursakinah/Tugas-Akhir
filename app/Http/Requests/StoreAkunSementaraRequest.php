<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAkunSementaraRequest extends FormRequest
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
            'akun_ids' => 'required|array',
        ];
    }
    public function messages(): array
    {
        return [
            'akun_ids.required' => 'Harap pilih minimal satu akun.',
            'akun_ids.array' => 'Format data akun tidak valid.',
        ];
    }
}
