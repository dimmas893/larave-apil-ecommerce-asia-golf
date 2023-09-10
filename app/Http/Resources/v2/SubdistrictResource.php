<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubdistrictResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource;
    }
}
