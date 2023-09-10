<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'unique:users'
            ],
            // 'email' => 'required',
            'password' => 'required|confirmed',
            'name' => 'required',
            'whatsapp' => 'nullable',
            'phone' => 'nullable',
        ];
    }
}