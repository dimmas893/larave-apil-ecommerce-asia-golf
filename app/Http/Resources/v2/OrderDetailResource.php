<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'qty' => $this->resource->qty,
            'price' => $this->resource->price,
            'discount' => $this->resource->discount,
            'total' => $this->resource->total,
            'product' => new ProductResource($this->resource->product)
        ];
    }
}
