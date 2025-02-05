<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['client']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'year_id' => ['required', 'exists:years,id'], // Pastikan tahun ajaran yang dipilih valid
            'child_id' => ['required', 'array'], // Pastikan child_id adalah array
            'child_id.*' => ['exists:childrens,id'], // Pastikan setiap child_id yang dipilih valid
            'courses' => ['required', 'array'], // Pastikan courses adalah array
            'courses.*' => ['exists:courses,id'], // Pastikan setiap course yang dipilih valid
            'promo_code' => ['sometimes', 'nullable', 'string', 'exists:discounts,code'], // Kode promo opsional, tapi jika ada harus valid
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'year_id.required' => 'Tahun ajaran harus dipilih.',
            'year_id.exists' => 'Tahun ajaran yang dipilih tidak valid.',
            'child_id.required' => 'Anak harus dipilih.',
            'child_id.array' => 'Anak harus dipilih dalam bentuk array.',
            'child_id.*.exists' => 'Anak yang dipilih tidak valid.',
            'courses.required' => 'Mata pelajaran harus dipilih.',
            'courses.array' => 'Mata pelajaran harus dipilih dalam bentuk array.',
            'courses.*.exists' => 'Mata pelajaran yang dipilih tidak valid.',
            'promo_code.exists' => 'Kode promo yang dimasukkan tidak valid.',
            'payment_method.required' => 'Metode pembayaran harus dipilih.',
            'payment_method.in' => 'Metode pembayaran yang dipilih tidak valid.',
        ];
    }
}