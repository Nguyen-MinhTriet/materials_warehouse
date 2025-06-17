<?php

namespace App\Http\Requests\Batch;

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
                'unique:App\Models\batch,name',
            ],
            'material_id' => ['required', 'exists:materials,id'],
            'import_receipt_id' => ['required', 'exists:import_receipts,id'],
            'import_quantity' => ['required', 'integer', 'min:1'],
            'import_price' => ['required', 'numeric', 'min:0'],
            'import_date' => ['required', 'date', 'before_or_equal:today'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên lô',
            'material_id' => 'Vật tư',
            'import_receipt_id' => 'Phiếu nhập',
            'import_quantity' => 'Số lượng nhập',
            'import_price' => 'Giá nhập',
            'import_date' => 'Ngày lập',
            'stock_quantity' => 'Số lượng tồn',
        ];
    }

    public function messages(): array
    {
        return [
            'material_id.required' => ':attribute không được để trống.',
            'material_id.exists' => ':attribute không tồn tại.',
            'import_receipt_id.required' => ':attribute không được để trống.',
            'import_receipt_id.exists' => ':attribute không tồn tại.',
            'import_quantity.required' => ':attribute không được để trống.',
            'import_quantity.integer' => ':attribute phải là số nguyên.',
            'import_quantity.min' => ':attribute phải lớn hơn hoặc bằng 1.',
            'import_price.required' => ':attribute không được để trống.',
            'import_price.numeric' => ':attribute phải là số.',
            'import_price.min' => ':attribute không được nhỏ hơn 0.',
            'import_date.required' => ':attribute không được để trống.',
            'import_date.date' => ':attribute phải là định dạng ngày hợp lệ.',
            'import_date.before_or_equal' => ':attribute không được sau ngày hiện tại.',
            'stock_quantity.required' => ':attribute không được để trống.',
            'stock_quantity.integer' => ':attribute phải là số nguyên.',
            'stock_quantity.min' => ':attribute không được nhỏ hơn 0.',
        ];
    }
}
