<?php

namespace App\Http\Requests\Warehouse;

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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            'image' => [
                'nullable',
                'file',
                'max:3000',
                'mimes:webp,png,jpg',
            ],
            'longitude' => [
                'required',
                'numeric',
            ],
            'latitude' => [
                'required',
                'numeric',
            ],
            'status' => 'required|in:0,1',
        ];
    }
}
