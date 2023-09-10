<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileCrudRequest extends FormRequest
{
    public function rules()
    {
        return [
            'photo' => [
                'required'
            ],
            'email' => [
                'required'
            ],
            'phone' => [
                'required'
            ],
        ];
    }
}
