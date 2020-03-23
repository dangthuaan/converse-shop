<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($this->product),
            ],
            'gender' => 'required',
            'category' => 'required',
            'publish_date' => 'required|date',
            'price' => 'required|integer',
            'sale' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This product has already been taken!',
        ];
    }
}
