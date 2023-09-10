<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductItemVariantResource extends JsonResource
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
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'item' => (new ItemResource($this->resource->item))->withProductableType($this->productableType),
        ];
    }
}
