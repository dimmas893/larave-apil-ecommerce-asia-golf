<?php

namespace App\Http\Resources;

use App\Models\DiscountItem;
use App\Models\MetaItem;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ItemResource extends ResourceCollection
{
    public static $wrap = null;
    public function toArray($request)
    {
        return  [
            'data' => $this->collection->transform(function ($item) {
                $tanggalhariini = Carbon::now()->Format('Y-m-d');
                $metaitem = MetaItem::where('item_id', (int)$item->id)->first();
                $datadiskon = DiscountItem::where('item_id', $item->id)->where('end', '>=', $tanggalhariini)->where('start', '<=', $tanggalhariini)->first();
                if ($datadiskon) {
                    $hargaitem = $item->harga * $datadiskon->discount / 100;
                    $persentase_discount = $datadiskon->discount . '%';
                    $harga_asli = $item->harga;
                    $hemat = $hargaitem;
                    $price = $item->harga - $hargaitem;
                } else {
                    $harga_asli = $item->harga;
                    $hemat = '';
                    $persentase_discount = '';
                    $price = $item->harga;
                }
                return [
                    'id' => $item->id,
                    'image' => Storage::url('item/' . $item->image),
                    'name' => $item->name,
                    'rating' => $metaitem->rating,
                    'terjual' => (int)$metaitem->terjual,
                    'persentase_discount' => $persentase_discount,
                    'harga_asli' => (int)$harga_asli,
                    'hemat' => $hemat,
                    'price' => (int)$price,
                ];
            }),
        ];
    }
}
