<?php

namespace App\Http\Requests\Export_receipt_detail;

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
            'export_receipt_id' => ['required', 'exists:export_receipts,id'],
            'material_id' => ['required', 'exists:materials,id'],
            'batch_id' => ['required', 'exists:batches,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'total_price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'export_receipt_id' => 'Phiếu xuất',
            'material_id' => 'Vật tư',
            'batch_id' => 'Lô hàng',
            'quantity' => 'Số lượng',
            'total_price' => 'Tổng tiền',
        ];
    }

    public function messages(): array
    {
        return [
            'export_receipt_id.required' => ':attribute không được để trống.',
            'export_receipt_id.exists' => ':attribute không tồn tại.',
            'material_id.required' => ':attribute không được để trống.',
            'material_id.exists' => ':attribute không tồn tại.',
            'batch_id.required' => ':attribute không được để trống.',
            'batch_id.exists' => ':attribute không tồn tại.',
            'quantity.required' => ':attribute không được để trống.',
            'quantity.integer' => ':attribute phải là số nguyên.',
            'quantity.min' => ':attribute phải lớn hơn hoặc bằng 1.',
            'total_price.required' => ':attribute không được để trống.',
            'total_price.numeric' => ':attribute phải là số.',
            'total_price.min' => ':attribute không được nhỏ hơn 0.',
        ];
    }
}
