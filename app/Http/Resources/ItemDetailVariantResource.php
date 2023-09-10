<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ItemDetailVariantResource extends ResourceCollection
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
            'data' => [
                'total_varian' => count($this->collection),
                'total_page_image' => count($this->collection),
                'data' => $this->collection->transform(function ($data, $index) {
                    return [
                        'name' => $data->name,
                        'id_page_image' => $index + 1,
                        'image' => Storage::url('item_varian/' . $data->image)
                    ];
                }),
            ]
        ];
    }
}
