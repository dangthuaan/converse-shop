<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPassword;

class PasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', 'string', new CurrentPassword],
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }
}
