<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'product' => new ProductResource($this->resource->product),
            'createdAt' => $this->resource->created_at
        ];
    }
}
