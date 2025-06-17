<?php

namespace App\Http\Requests\Material;

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
                'max:255',
                'unique:App\Models\Material,name,' . $this->id,
            ],
            'price' => [
                'bail',
                'required',
                'numeric',
                'min:0',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif',
                'max:3000',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'expiration_date' => [
                'nullable',
                'date',
                'after_or_equal:manufacture_date',
            ],
            'manufacture_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],
            'category_id' => [
                'bail',
                'required',
                'exists:App\Models\Category,id',
            ],
            'unit_id' => [
                'bail',
                'required',
                'exists:App\Models\Unit,id',
            ],
            'quantity' => [
                'bail',
                'required',
                'integer',
                'min:0',
            ],
            'information' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'status' => 'required|in:0,1',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên',
            'price' => 'Giá',
            'image' => 'Hình',
            'description' => 'Mô tả',
            'expiration_date' => 'Hạn sử dụng',
            'manufacture_date' => 'Ngày sản xuất',
            'category_id' => 'Danh mục',
            'unit_id' => 'Đơn vị tính',
            'quantity' => 'Số lượng',
            'information' => 'Thông tin',
            'status' => 'Trạng thái',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.string' => ':attribute phải là chuỗi ký tự.',
            'name.max' => ':attribute không được vượt quá 255 ký tự.',
            'name.unique' => ':attribute đã tồn tại.',
            'price.required' => ':attribute không được để trống.',
            'price.numeric' => ':attribute phải là số.',
            'price.min' => ':attribute không được nhỏ hơn 0.',
            'image.image' => ':attribute phải là một hình ảnh.',
            'image.mimes' => ':attribute chỉ hỗ trợ định dạng jpg, jpeg, png, gif.',
            'image.max' => ':attribute không được vượt quá 2MB.',
            'description.string' => ':attribute phải là chuỗi ký tự.',
            'description.max' => ':attribute không được vượt quá 1000 ký tự.',
            'expiration_date.date' => ':attribute phải là định dạng ngày hợp lệ.',
            'expiration_date.after_or_equal' => ':attribute phải sau hoặc bằng ngày sản xuất.',
            'manufacture_date.date' => ':attribute phải là định dạng ngày hợp lệ.',
            'manufacture_date.before_or_equal' => ':attribute không được sau ngày hiện tại.',
            'category_id.required' => ':attribute không được để trống.',
            'category_id.exists' => ':attribute không tồn tại.',
            'unit_id.required' => ':attribute không được để trống.',
            'unit_id.exists' => ':attribute không tồn tại.',
            'quantity.required' => ':attribute không được để trống.',
            'quantity.integer' => ':attribute phải là số nguyên.',
            'quantity.min' => ':attribute không được nhỏ hơn 0.',
            'information.string' => ':attribute phải là chuỗi ký tự.',
            'information.max' => ':attribute không được vượt quá 1000 ký tự.',
            'status.required' => ':attribute không được để trống.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }
}
