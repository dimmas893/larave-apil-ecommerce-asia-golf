<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AlamatResource extends ResourceCollection
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
            'data' => $this->collection->transform(function ($alamat) {
                return [
                    'id' => $alamat->id,
                    'jenis' => $alamat->jenis,
                    'country' => $alamat->country,
                    'city' => $alamat->city,
                    'address' => $alamat->address,
                    'status' => $alamat->status
                ];
            }),
        ];
    }
}
