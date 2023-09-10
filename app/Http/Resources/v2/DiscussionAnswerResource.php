<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionAnswerResource extends JsonResource
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
            'content' => $this->resource->content,
            'user' => new UserResource($this->resource->user),
        ];
    }
}