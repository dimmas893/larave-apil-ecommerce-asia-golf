<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemMetaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'sold' => (int) $this->resource->sold,
            'review' => (int) $this->resource->review,
            'discussion' => (int) $this->resource->discussion,
            'rating' => $this->resource->rating,
            'createdAt' => $this->resource->created_at,
        ];
    }
}
