<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => [
                'required',
                'string'
            ],
            'weight' => [
                'nullable',
                'numeric'
            ],
            'courier' => [
                'required',
                'string'
            ],
        ];
    }
}
