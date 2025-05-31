<?php

namespace App\Http\Requests\PaymentMethods;

use App\Models\payment_methods;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            // 'name' => [
            //     'bail',
            //     'required',
            //     'string',
            //     // 'unique:App\Models\Category,name',
            //     Rule::unique(payment_methods::class)->ignore($this->payment_methods),
            // ],
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
