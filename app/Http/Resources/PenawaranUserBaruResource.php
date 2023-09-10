<?php

namespace App\Http\Resources;

use App\Models\DiscountItem;
use App\Models\Item;
use App\Models\MetaItem;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class PenawaranUserBaruResource extends ResourceCollection
{
    public function toArray($request)
    {
        return  [
            'data' => $this->collection->transform(function ($data) {
                $item = Item::where('id', $data->id)->first();
                $metaitem = MetaItem::where('item_id', $data->id)->first();
                $hargaitem = $item->harga * $data->discount / 100;
                // dd($hargaitem);
                $persentase_discount = $data->discount . '%';
                $harga_asli = $item->harga;
                $diskon = $hargaitem;
                $price = $item->harga - $hargaitem;
                return [
                    'id' => $item->id,
                    'image' => Storage::url('item/' . $item->image),
                    'name' => $item->name,
                    'rating' => $metaitem->rating,
                    'terjual' => (int)$metaitem->terjual,
                    'persentase_discount' => $persentase_discount,
                    'harga_asli' => (int)$harga_asli,
                    'diskon' => $diskon,
                    'price' => (int)$price,
                ];
            }),
        ];
    }
}
