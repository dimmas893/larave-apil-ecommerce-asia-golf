<?php

namespace App\Http\Requests;

use App\Models\ItemPhoto;
use App\Models\ItemVariant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Item;

class ItemPhotoRequest extends FormRequest
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
                'itemVariantId' => [
                    'required',
                    Rule::exists(ItemVariant::class, 'id')
                ],
                'fileName' => [
                    'required',
                    'file'
                ],
            ];
        } else {
            return [
                'itemVariantId' => [
                    'nullable',
                    // Rule::unique(ItemPhoto::class, 'item_variant_id')->ignore($this->itemPhoto, 'itemVariantId'),
                    Rule::exists(ItemVariant::class, 'id')
                ],
                'fileName' => [
                    'nullable',
                    'file'
                ],
            ];
        }
    }
}