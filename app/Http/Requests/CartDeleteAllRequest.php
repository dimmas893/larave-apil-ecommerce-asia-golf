<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartDeleteAllRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "carts" => [
                'required'
            ],
            'carts.*.id' => [
                'required',
                Rule::exists(Cart::class, 'id')
            ],
        ];
    }
}