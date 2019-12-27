<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($this->product),
            ],
            'gender' => 'required',
            'category' => 'required',
            'publish_date' => 'required|date',
            'price' => 'required|integer',
            'sale' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This product has already been taken!'
        ];
    }
}
