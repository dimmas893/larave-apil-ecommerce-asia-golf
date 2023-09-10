<?php

namespace App\Http\Resources\v2\home;

use App\Http\Resources\v2\ItemPhotoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            // 'number' => $this->resource->number,
            // 'minimal_order' => $this->resource->minimal_order,
            // 'isBestseller' => $this->resource->is_bestseller,
            // 'gender' => $this->resource->gender,
            // 'brandId' => $this->resource->brand_id,
            'weight' => $this->resource->weight,
            'price' => $this->resource->price,
            // 'description' => $this->resource->deskripsi,
            // 'createdAt' => $this->resource->created_at,
            'itemImage' => $this->resource->itemPhoto != null ? ItemPhotoResource::collection($this->resource->itemPhoto) : [],
            'itemMeta' => $this->resource->itemMeta != null ? new MetaItemResource($this->resource->itemMeta) : [],
            'stock' => $this->resource->stock != null ? StockResource::collection($this->resource->stock)->sum('amount') : [],
            'discount' => $this->resource->discount != null ? new DiscountItemResource($this->resource->discount) : [],
        ];
    }
}
