<?php

namespace App\Http\Requests\Export_receipt;

use Illuminate\Foundation\Http\FormRequest;

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
           'employee_id' => 'required|exists:employees,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'customer_id' => 'required|exists:customers,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'issued_date' => 'required|date',
            'status' => 'required|in:0,1',
            'total_amount' => 'required|numeric|min:0',
            'details' => 'required|array',
            'details.*.material_id' => 'required|exists:materials,id',
            'details.*.batch_id' => 'required|exists:batches,id',
            'details.*.quantity' => 'required|numeric|min:1',
            'details.*.total_price' => 'required|numeric|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'employee_id' => 'Tên nhân viên',
            'warehouse_id' => 'Kho',
            'payment_method_id' => 'Phương thức thanh toán',
            'customer_id' => 'Khách hàng',
            'issued_date' => 'Ngày lập',
            'total_amount' => 'Tổng tiền',
            'status' => 'Trạng thái',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => ':attribute không được để trống.',
            'employee_id.exists' => ':attribute không tồn tại.',
            'warehouse_id.required' => ':attribute không được để trống.',
            'warehouse_id.exists' => ':attribute không tồn tại.',
            'payment_method_id.required' => ':attribute không được để trống.',
            'payment_method_id.exists' => ':attribute không tồn tại.',
            'customer_id.required' => ':attribute không được để trống.',
            'customer_id.exists' => ':attribute không tồn tại.',
            'issued_date.required' => ':attribute không được để trống.',
            'issued_date.date' => ':attribute phải là định dạng ngày hợp lệ.',
            'issued_date.before_or_equal' => ':attribute không được sau ngày hiện tại.',
            'total_amount.required' => ':attribute không được để trống.',
            'total_amount.numeric' => ':attribute phải là số.',
            'total_amount.min' => ':attribute không được nhỏ hơn 0.',
            'status.required' => ':attribute không được để trống.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }
}
