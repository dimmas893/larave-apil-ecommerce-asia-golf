<?php

namespace App\Http\Requests;

use App\Models\Item;
use App\Models\ItemVariant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemVariantRequest extends FormRequest
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
                'code' => [
                    'required',
                    'unique:item_variants'
                ],
                'name' => [
                    'required'
                ],
                'itemId' => [
                    'required',
                    Rule::exists(Item::class, 'id')

                ],
            ];
        } else {
            return [
                'code' => [
                    'nullable',
                    Rule::unique(ItemVariant::class, 'code')->ignore($this->itemVariant->code, 'code')
                ],
                'name' => [
                    'nullable'
                ],
                'itemId' => [
                    'nullable',
                    Rule::exists(Item::class, 'id')

                ],
            ];
        }
    }
}