<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemReviewRequest extends FormRequest
{
    public function rules()
    {
        return [
            'rating' => [
                'nullable',
                'in:1,2,3,4,5'
            ],
            'sort' => [
                'nullable',
                'in:ASC,DESC'
            ],
        ];
    }
}
