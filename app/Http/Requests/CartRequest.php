<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\ItemVariant;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartRequest extends FormRequest
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
                'productId' => [
                    'required',
                    Rule::exists(Product::class, 'id')
                ],
                'variantId' => [
                    'required',
                    Rule::exists(ItemVariant::class, 'id')
                ],
                'qty' => [
                    'required',
                    'numeric'
                ],
            ];
        } else {
            return [
                'productId' => [
                    'nullable',
                    Rule::exists(Product::class, 'id')
                ],
                'customerId' => [
                    'nullable',
                    Rule::exists(Customer::class, 'id')
                ],
                'variantId' => [
                    'nullable',
                    Rule::exists(ItemVariant::class, 'id')
                ],
                'qty' => [
                    'nullable',
                    'numeric'
                ],
            ];
        }
    }
}