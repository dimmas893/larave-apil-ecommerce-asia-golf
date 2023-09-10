<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
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
                'itemId' => [
                    'required',
                    Rule::exists(Item::class, 'id')
                ],
                'nominal' => [
                    'required',
                    'numeric'
                ],
                'type' => [
                    'required',
                    'in:newuser,flashsale'
                ],
                'startAt' => [
                    'required'
                ],
                'endAt' => [
                    'required'
                ],
            ];
        } else {
            return [
                'itemId' => [
                    'nullable',
                    Rule::exists(Item::class, 'id')
                ],
                'nominal' => [
                    'nullable',
                    'numeric'
                ],
                'type' => [
                    'nullable',
                    'in:newuser,flashsale'
                ],
                'startAt' => [
                    'nullable'
                ],
                'endAt' => [
                    'nullable'
                ],
            ];
        }
    }
}