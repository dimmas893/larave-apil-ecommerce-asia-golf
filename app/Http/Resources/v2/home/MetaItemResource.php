<?php

namespace App\Http\Resources\v2\home;

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
            'sold' => (int) $this->resource->sold,
            'rating' => $this->resource->rating,
        ];
    }
}