<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
        ];
        if ($this->resource->productable_type === 'App\Models\Item') {
            $data['productable'] = (new ItemResource($this->resource->productable))->withProductableType($this->resource->productable_type);
        } elseif ($this->resource->productable_type === 'App\Models\ItemVariant') {
            $data['productable'] = (new ProductItemVariantResource($this->resource->productable))->withProductableType($this->resource->productable_type);
        } else {
            $data['productable'] = (new ItemBundlingResource($this->resource->productable))->withProductableType($this->resource->productable_type);
        }
        $data['createdAt'] = $this->resource->created_at;
        return $data;
    }
}