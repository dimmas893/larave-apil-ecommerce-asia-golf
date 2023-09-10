<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
                'required'
            ],
            'address' => [
                'required'
            ],
            'subdistrict' => [
                'required',
            ],
            'city' => [
                'required'
            ],
            'province' => [
                'required'
            ],
            'latitude' => [
                'required'
            ],
            'longitude' => [
                'required'
            ],

            'is_active' => [
                'nullable'
            ]
        ];
    }
}