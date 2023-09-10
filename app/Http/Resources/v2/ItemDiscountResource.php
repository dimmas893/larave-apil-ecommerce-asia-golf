<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemDiscountResource extends JsonResource
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
            'nominal' => $this->resource->nominal,
            'start_at' => $this->resource->start_at,
            'end_at' => $this->resource->end_at,
            'createdAt' => $this->resource->created_at
        ];
    }
}
