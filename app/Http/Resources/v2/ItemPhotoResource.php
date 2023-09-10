<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ItemPhotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'fileName' => url(Storage::url('storage/itemPhoto/' . $this->resource->filename)),
            'isDefault' => $this->resource->is_default,

        ];
    }
}
