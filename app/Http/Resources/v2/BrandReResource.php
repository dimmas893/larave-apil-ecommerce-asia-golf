<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BrandReResource extends JsonResource
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
            // 'logo' => Storage::url('brand/' . $this->resource->logo),
            'logo' => url(Storage::url($this->resource->logo)),
            'isAuthorized' => $this->resource->is_authorized,
            'isExclusive' => $this->resource->is_exclusive,
            'createdAt' => $this->resource->created_at
        ];
    }
}