<?php

namespace App\Http\Resources\v2;

use App\Models\Discussion;
use App\Models\ItemVariant;
use App\Models\Stock;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{

    protected $productableType;

    /**
     * Set the productable type.
     *
     * @param string $productableType
     * @return $this
     */
    public function withProductableType($productableType)
    {
        $this->productableType = $productableType;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'number' => $this->resource->number,
            'minimal_order' => $this->resource->minimal_order,
            'isBestseller' => $this->resource->is_bestseller,
            'gender' => $this->resource->gender,
            'brandId' => $this->resource->brand_id,
            'weight' => $this->resource->weight,
            'price' => $this->resource->price,
            'description' => $this->resource->deskripsi,
            'createdAt' => $this->resource->created_at,
            'itemImage' => $this->resource->itemPhoto != null ? ItemPhotoResource::collection($this->resource->itemPhoto) : [],
            'discount' => $this->resource->discount != null ? new DiscountItemResource($this->resource->discount) : [],
            'stock' => $this->resource->stock != null ? StockResource::collection($this->resource->stock)->sum('amount') : [],
            'itemMeta' => $this->resource->itemMeta != null ? new MetaItemResource($this->resource->itemMeta) : [],
            'itemReview' => $this->resource->itemReview != null ? ItemReviewResource::collection($this->resource->itemReview) : [],
            'discussion' => $this->resource->discussion != null ? DiscussionResource::collection($this->resource->discussion) : [],

        ];

        if ($this->productableType != 'App\Models\ItemVariant') {
            $data['itemVariant'] = $this->resource->itemVariant != null ? ItemVariantResource::collection($this->resource->itemVariant) : [];
        }

        return $data;
    }
}