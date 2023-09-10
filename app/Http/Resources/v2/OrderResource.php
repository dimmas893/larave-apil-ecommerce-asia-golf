<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->resource->orderDetail);
        return [
            'id' => $this->resource->id,
            'number' => $this->resource->number,
            'subtotal' => $this->resource->subtotal,
            'discount' => $this->resource->discount,
            'tax' => $this->resource->tax,
            'shipping_fee' => $this->resource->shipping_fee,
            'total' => $this->resource->total,
            'status' => $this->resource->status,
            'date_checkout' => $this->resource->date_checkout,
            'end_paid' => $this->resource->end_paid,
            'method' => $this->resource->method,
            'number_paid' => $this->resource->number_paid,
            'note' => $this->resource->note,
            'itemDetail' =>  OrderDetailResource::collection($this->resource->orderDetail),
            'address' => new AddressResource($this->resource->address)
        ];
    }
}
