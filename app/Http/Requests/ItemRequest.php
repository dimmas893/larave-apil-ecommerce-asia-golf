<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemVariant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
                'number' => [
                    'required',
                    'unique:items'
                ],
                'name' => [
                    'required'
                ],
                'minimalOrder' => [
                    'required'
                ],
                'isBestseller' => [
                    'required',
                    'in:true,false'
                ],
                'gender' => [
                    'required'
                ],
                'price' => [
                    'required',
                ],
                'weight' => [
                    'required',
                ],
                'deskripsi' => [
                    'required',
                ],
                'brandId' => [
                    'required',
                    Rule::exists(Brand::class, 'id')
                ],
                'categoryId' => [
                    'required',
                    Rule::exists(Category::class, 'id')
                ],

                'itemVariants' => [
                    'required'
                ],
                'itemVariants.*.code' => [
                    'required',
                    Rule::unique('item_variants', 'code')

                ],
                'itemVariants.*.name' => [
                    'required'
                ],

            ];
        } else {
            return [
                'number' => [
                    'nullable',
                    // 'unique:items'
                    Rule::unique(Item::class, 'number')->ignore($this->item->number, 'number')

                ],
                'name' => [
                    'nullable'
                ],
                'minimalOrder' => [
                    'nullable'
                ],
                'isBestseller' => [
                    'nullable',
                    'in:true,false'
                ],
                'gender' => [
                    'nullable'
                ],
                'price' => [
                    'nullable',
                ],
                'weight' => [
                    'nullable',
                ],
                'deskripsi' => [
                    'nullable',
                ],
                'brandId' => [
                    'nullable',
                    Rule::exists(Brand::class, 'id')
                ],
                'categoryId' => [
                    'nullable',
                    Rule::exists(Category::class, 'id')
                ],

                'itemVariants.*.code' => [
                    'required',
                    Rule::unique('item_variants', 'code')->where(function ($query) {
                        $query->where('item_id', '<>', $this->item->id);
                    })
                ],
                'itemVariants.*.name' => [
                    'required'
                ],

            ];
        }
    }
}