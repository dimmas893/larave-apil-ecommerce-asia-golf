<?php

namespace App\Http\Resources;

use App\Models\MetaItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class UlasanResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->tampungdatarow = [];
        $this->collection->transform(function ($pertanyaan) {

            $ulasan['customer'] = $pertanyaan->user->name;
            $ulasan['rating'] = $pertanyaan->rating;
            $ulasan['ulasan'] = $pertanyaan->ulasan;
            $ulasan['image'] = Storage::url('ulasan_image/' . $pertanyaan->image);
            $ulasan['time'] = $pertanyaan->created_at->diffForHumans();
            array_push($this->tampungdatarow, $ulasan);
            $this->meta = $pertanyaan->id_item;
        });
        $this->metaitem = MetaItem::where('item_id', $this->meta)->firstOrFail();
        return [
            'data' => [
                'total_ulasan' =>  $this->metaitem->ulasan,
                'rating' =>  $this->metaitem->rating,
                'data' =>  $this->tampungdatarow
            ]
        ];
    }
}
