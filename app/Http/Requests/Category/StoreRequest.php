<?php

namespace App\Http\Requests\category;

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
                'unique:App\Models\Category,name',
            ],
            'status' => 'required|in:0,1',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'status' => 'Trạng thái',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.unique' => ':attribute đã tồn tại.',
            'status.required' => ':attribute là bắt buộc.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }
}
