<?php

namespace App\Http\Resources\v2;

use App\Models\ItemVariant;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

// class ItemVariantResource extends ResourceCollection
class ItemVariantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'itemPhoto' => $this->resource->itemPhoto != null ? new ItemPhotoResource($this->resource->itemPhoto) : [],
            'stock' => $this->resource->stock != null ? new StockResource($this->resource->stock) : [],
        ];
    }
}
