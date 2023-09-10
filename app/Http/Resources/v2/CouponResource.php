<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'code' => $this->resource->code,
            'description' => $this->resource->description,
            'nominal' => $this->resource->nominal,
            'start_at' => $this->resource->start_at,
            'end_at' => $this->resource->end_at,
            'is_active' => $this->resource->is_active,
        ];
    }
}
