<?php

namespace App\Http\Resources\v2\home;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            // 'code' => $this->resource->code,
            'name' => $this->resource->name,
        ];
        if ($this->resource->productable_type === 'App\Models\Item') {
            $data['productable'] = new ItemResource($this->resource->productable);
        }
        $data['createdAt'] = $this->resource->created_at;
        return $data;
    }
}
