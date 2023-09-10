<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShippingResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection;
    }
}
