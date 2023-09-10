<?php

namespace App\Http\Resources\V2;

use App\Http\Resources\v2\ItemResource;
use App\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartResource extends JsonResource
{
    // public function toArray($request)
    // {
    // $this->simpandatarow = [];
    // $this->collection->transform(function ($cart) {
    //     $this->item = Item::where('id', $cart->item_id)->first();
    //     array_push($this->simpandatarow, new ItemResource($this->item));
    // });
    // return $this->simpandatarow;
    // }

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'product' => new ProductResource($this->resource->product),
            'customer' => new CustomerResource($this->resource->customer),
            'itemVariant' => new ItemVariantResource($this->resource->itemVariant),
            'qty' => $this->resource->qty,
        ];
    }
}