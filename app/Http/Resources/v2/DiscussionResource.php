<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionResource extends JsonResource
{
    public function toArray($request)
    {
        // dd($this->resource->discussionAnswer);
        return [
            'id' => $this->resource->id,
            'content' => $this->resource->content,
            // 'customer' => $this->resource->customer->name,
            'customer' => new CustomerResource($this->resource->customer),
            // 'answer' => DiscussionAnswerResource::collection($this->resource->discussionAnswer),
            // 'answer' => $this->resource->discussionAnswer != null ? DiscussionAnswerResource::collection($this->resource->discussionAnswer) : [],
            'createdAt' => $this->resource->created_at,
        ];
    }
}
