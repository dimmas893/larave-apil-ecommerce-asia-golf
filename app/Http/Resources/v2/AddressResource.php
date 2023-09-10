<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'name' => $this->resource->name,
            'address' => $this->resource->address,
            'subdistrict' => $this->resource->subdistrict,
            'city' => $this->resource->city,
            'province' => $this->resource->province,
            'longitude' => $this->resource->longitude,
            'latitude' => $this->resource->latitude,
            'is_active' => $this->resource->is_active,
            'created_at' => $this->resource->created_at
        ];
    }
}
