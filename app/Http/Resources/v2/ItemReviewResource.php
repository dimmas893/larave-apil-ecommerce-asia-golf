<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ItemReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            // 'customer' => $this->resource->customer->name,
            'customer' => new CustomerResource($this->resource->customer),
            'content' => $this->resource->content,
            'image' => Storage::url('storage/itemReview/' . $this->resource->photo),
            'rating' => $this->resource->rating,
            'created_at' => $this->resource->created_at,
        ];
    }
}
