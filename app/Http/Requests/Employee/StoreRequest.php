<?php

namespace App\Http\Requests\Employee;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:155|unique:employees,email',
            'phone' => 'required|string|max:10|regex:/^[0-9]{10}$/', // Quy tắc mới            'address' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'contract' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'birth_date' => 'required|date|before:today',
            'warehouse_id' => 'required|exists:warehouses,id',
            'status' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhân viên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại phải có định dạng xxxx-xxxx.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'position.required' => 'Vui lòng nhập chức vụ.',
            'contract.required' => 'Vui lòng nhập loại hợp đồng.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'birth_date.required' => 'Vui lòng chọn ngày sinh.',
            'birth_date.before' => 'Ngày sinh phải là ngày trong quá khứ.',
            'warehouse_id.required' => 'Vui lòng chọn kho.',
            'warehouse_id.exists' => 'Kho không tồn tại.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ];
    }
}
