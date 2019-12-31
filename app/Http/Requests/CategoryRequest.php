<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Category;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('categories')->ignore($this->category)
            ],
            'parent_id' =>  [
                'nullable'
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'The category name has already been taken!'
        ];
    }
}
