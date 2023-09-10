<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaItemResource extends JsonResource
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
            'sold' => (int) $this->resource->sold,
            'review' => (int) $this->resource->review,
            'discussion' => (int) $this->resource->discussion,
            'rating' => $this->resource->rating,
            'countImage' => $this->resource->count_image,
            'createdAt' => $this->resource->created_at,
        ];
    }
}
