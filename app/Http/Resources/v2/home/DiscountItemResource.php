<?php

namespace App\Http\Resources\v2\home;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountItemResource extends JsonResource
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
            'nominal' => $this->resource->nominal,
            'startAt' => $this->resource->start_at,
            'endAt' => $this->resource->end_at,
            'type' => $this->resource->type,
        ];
    }
}