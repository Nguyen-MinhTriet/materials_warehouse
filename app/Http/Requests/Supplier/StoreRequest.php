<?php

namespace App\Http\Requests\Supplier;

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
            'name' => ['required', 'string', 'max:100'], // Tên nhà cung cấp, tối đa 100 ký tự
            'country' => ['required', 'string', 'max:50'], // Quốc gia, tối đa 50 ký tự
            'address' => ['required', 'string', 'max:255'], // Địa chỉ, tối đa 255 ký tự
            'phone' => ['required', 'string', 'regex:/^[0-9]{10,12}$/'], // Số điện thoại, 10-12 chữ số
            'tax_code' => ['required', 'string', 'regex:/^[0-9]{10,12}$/'], // Mã số thuế, 10-12 chữ số
            'contact_person' => ['required', 'string', 'max:100'], // Người liên hệ, tối đa 100 ký tự
            'status' => 'required|in:0,1',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'country' => 'Quốc gia', // Quốc gia, tối đa 50 ký tự
            'address' => 'Địa chỉ', // Địa chỉ, tối đa 255 ký tự
            'phone' => 'Số điện thoại', // Số điện thoại, 10-12 chữ số
            'tax_code' => 'Mã số thuế', // Mã số thuế, 10-12 chữ số
            'contact_person' => 'Người đại điện', // Người liên hệ, tối đa 100 ký tự
            'status' => 'Trạng thái',
        ];
    }

    public function messages()
    {
        return [

        'name.required' => ':attribute không được để trống.',
        'name.string' => ':attribute phải là một chuỗi ký tự.',
        'name.max' => ':attribute không được dài quá 100 ký tự.',

        // Messages cho 'country'
        'country.required' => ':attribute không được để trống.',
        'country.string' => ':attribute phải là một chuỗi ký tự.',
        'country.max' => ':attribute không được dài quá 50 ký tự.',

        // Messages cho 'address'
        'address.required' => ':attribute không được để trống.',
        'address.string' => ':attribute phải là một chuỗi ký tự.',
        'address.max' => ':attribute không được dài quá 255 ký tự.',

        // Messages cho 'phone'
        'phone.required' => ':attribute không được để trống.',
        'phone.string' => ':attribute phải là một chuỗi ký tự.',
        'phone.regex' => ':attribute phải là số và có độ dài từ 10 đến 12 chữ số.',

        // Messages cho 'tax_code'
        'tax_code.required' => ':attribute không được để trống.',
        'tax_code.string' => ':attribute phải là một chuỗi ký tự.',
        'tax_code.regex' => ':attribute phải là số và có độ dài từ 10 đến 12 chữ số.',

        // Messages cho 'contact_person'
        'contact_person.required' => ':attribute không được để trống.',
        'contact_person.string' => ':attribute phải là một chuỗi ký tự.',
        'contact_person.max' => ':attribute không được dài quá 100 ký tự.',

        // Messages cho 'status'
        'status.required' => ':attribute là bắt buộc.',
        'status.in' => ':attribute không hợp lệ, chỉ được chọn giữa "active" hoặc "inactive".',
        ];
    }
}
