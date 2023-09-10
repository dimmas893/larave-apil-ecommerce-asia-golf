<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                    'required',
                ],
                'logo' => [
                    'required',
                    'file'
                ],
                'isAuthorized' => [
                    'required',
                    'in:true,false'
                ],
                'isExclusive' => [
                    'required',
                    'in:true,false'
                ],
            ];
        } else {
            return [
                'name' => [
                    'nullable',
                ],
                'logo' => [
                    'nullable',
                    'file'
                ],
                'isAuthorized' => [
                    'nullable',
                    'in:true,false'
                ],
                'isExclusive' => [
                    'nullable',
                    'in:true,false'
                ],
            ];
        }
    }
}