<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemBundlingResource extends JsonResource
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
        // dd($this->resource->itemBundlingDetails);
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'price' => $this->resource->price,
            'saving' => $this->resource->saving,
            'itemBundlingDetail' => ItemBundlingDetailResource::collection($this->resource->itemBundlingDetails),
        ];
    }
}
