<?php

namespace App\Http\Requests\Customer;

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
            'nickname' => 'required|string|max:255',
            'phone' => 'required|string|max:10|regex:/^[0-9]{10}$/', // Quy tắc mới            'address' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ];
    }

    public function attributes()
    {
        
        return
        [
            'name' => 'Tên khách hàng',
            'nickname' => 'Biệt danh',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'status' => 'Trạng thái',
        ];
    }

    public function messages(){
        return[
            'name.required' => ':attribute không được để trống.',
            'name.unique' => ':attribute đã tồn tại.',
            'phone.required' =>':attibute không được để trống',
            'address.required'=>':attibute không được để trống',
            'status.required' => ':attribute là bắt buộc.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

}
