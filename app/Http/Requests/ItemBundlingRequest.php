<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemBundlingRequest extends FormRequest
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
                "name" => [
                    'required'
                ],
                "price" => [
                    'required',
                    'numeric'
                ],
                "saving" => [
                    'required'
                ],

                "item" => [
                    'required'
                ],
                'item.*.id' => [
                    'required',
                    Rule::exists(Item::class, 'id')
                ],
            ];
        } else {
            return [
                "name" => [
                    'nullable'
                ],
                "price" => [
                    'nullable',
                    'numeric'
                ],
                "saving" => [
                    'nullable'
                ],

                "item" => [
                    'nullable'
                ],
                'item.*.id' => [
                    'nullable',
                    Rule::exists(Item::class, 'id')
                ],
            ];
        }
    }
}