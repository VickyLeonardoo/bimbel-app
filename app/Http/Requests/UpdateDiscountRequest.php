<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $discountId = $this->route('discount');
        return [
            'name' => ['required'],
            'code' => [
                'required',
                Rule::unique('discounts', 'code')->ignore($discountId),
                'regex:/^[a-zA-Z0-9]+$/u', // Hanya huruf dan angka, tidak boleh ada spasi
            ],
            'total' => ['required','numeric'],
            'date_valid' => ['required'],
            'type' => ['required'],
        ];
    }
}
