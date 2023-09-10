<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionHistoryRequest extends FormRequest
{
    public function rules()
    {
        return [

            'perPage' => [
                'nullable'
            ],
            'sort' => [
                'nullable',
                'in:asc,desc'
            ],
            'status' => [
                'nullable'
            ],
        ];
    }
}
