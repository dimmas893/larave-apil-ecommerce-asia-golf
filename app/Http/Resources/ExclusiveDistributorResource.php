<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ExclusiveDistributorResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($exclusiveDistributor) {
                return [
                    'id' => $exclusiveDistributor->id,
                    'image' =>  Storage::url('brand/' . $exclusiveDistributor->brand->image),
                ];
            }),
        ];
    }
}
