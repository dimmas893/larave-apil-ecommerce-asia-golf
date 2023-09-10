<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountIndexRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'perPage' => [
                'nullable',
                'numeric'
            ],
            'page' => [
                'required',
                'numeric'
            ],
            'search' => [
                'nullable'
            ],
        ];
    }
}