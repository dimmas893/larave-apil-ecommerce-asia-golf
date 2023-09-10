<?php

namespace App\Http\Resources;

use App\Models\DiscountItem;
use App\Models\ItemGallery;
use App\Models\ItemVariant;
use App\Models\MetaItem;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ItemDetailResource extends JsonResource
{

    public function toArray($request)
    {
        $this->datagallery = [];
        $metaitem = MetaItem::where('item_id', $this->id)->first();
        $itemgallery = ItemGallery::where('item_id', $this->id)->get();
        $itemgallery->transform(function ($galleries) {
            array_push($this->datagallery, Storage::url('itemgallery/' . $galleries->image));
        });
        $tanggalhariini = Carbon::now()->Format('Y-m-d');
        $metaitem = MetaItem::where('item_id', $this->id)->first();
        $diskon = DiscountItem::where('item_id', $this->id)->where('end', '>=', $tanggalhariini)->where('start', '<=', $tanggalhariini)->first();
        if ($diskon) {
            $hargaitem = $this->harga * $diskon->discount / 100;
            $persentase_discount = $diskon->discount . '%';
            $harga_asli = $this->harga;
            $diskon = $hargaitem;
            $price = $this->harga - $hargaitem;
        } else {
            $harga_asli = $this->harga;
            $diskon = '';
            $persentase_discount = '';
            $price = $this->harga;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'deskripsi' => $this->deskripsi,
            'kondisi' => $this->kondisi,
            'min_pemesanan' => $this->min_pemesanan,
            'harga_asli' => (int)$harga_asli,
            'persentase_discount' => $persentase_discount,
            'price' => $price,
            'image' => Storage::url('item/' . $this->image),
            'galleries' => $this->datagallery,
            'rating' =>  $metaitem->rating,
            'terjual' =>  $metaitem->terjual,
            'foto_pembeli' =>  $metaitem->foto_pembeli,
            'pertanyaan' =>  $metaitem->pertanyaan,
        ];
    }
}
