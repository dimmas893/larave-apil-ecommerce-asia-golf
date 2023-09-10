<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
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
            'sort' => [
                'nullable',
                'in:ASC,DESC'
            ],
            // 'bestseller' => [
            //     'nullable',
            //     'in:true,false'
            // ],
            // 'paginate' => [
            //     'nullable',
            //     'in:true,false'
            // ],
            // 'random' => [
            //     'nullable',
            //     'in:true,false'
            // ],
        ];
    }
}