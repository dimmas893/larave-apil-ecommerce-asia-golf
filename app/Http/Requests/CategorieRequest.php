<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'name' => [
                    'required'
                ],
                'structure' => [
                    'required'
                ],
            ];
        } else {
            return [
                'name' => [
                    'nullable'
                ],
                'structure' => [
                    'nullable'
                ],
            ];
        }
    }
}