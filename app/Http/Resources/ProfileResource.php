<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->image === null) {
            $image = false;
        } else {
            $image = Storage::url('profil/' . $this->image);
        }
        return  [
            'id' => $this->id,
            'wa' => $this->wa,
            'email' => $this->email,
            'image' => $image,
        ];
    }
}
