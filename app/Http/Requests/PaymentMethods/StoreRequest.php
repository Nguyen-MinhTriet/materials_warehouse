<?php

namespace App\Http\Requests\PaymentMethods;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string',
                // 'unique:App\Models\payment_method,name',
            ],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.unique' => ':attribute đã tồn tại.',
        ];
    }
}
