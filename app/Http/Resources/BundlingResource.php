<?php

namespace App\Http\Resources;

use App\Models\Item;
use App\Models\ItemBundling;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class BundlingResource extends ResourceCollection
{
    public static $wrap = null;
    public function toArray($request)
    {
        $this->collection->transform(function ($bundling) {
            $this->dataharganorma = [];
            $this->datanamaitem = [];
            $this->simpandataraw = [];
            // $hargaitem = (int) $bundling->nominal ;
            // dd($hargaitem);
            $dataitembndling = ItemBundling::where('id_bundling', $bundling->id)->get();
            $dataitembndling->transform(function ($itemBundlingdata) {
                $itemmm = Item::where('id', $itemBundlingdata->id_item)->first();
                array_push($this->dataharganorma, $itemmm->harga * $itemBundlingdata->qty);
                $row['id'] =  $itemmm->id;
                $row['image'] =  Storage::url('item/' . $itemmm->image);
                $row['name'] =  $itemmm->name;
                $row['jumlah_item'] =  $itemBundlingdata->qty;
                $row['harga'] =  $itemmm->harga * $itemBundlingdata->qty;
                array_push($this->datanamaitem, $row);
            });
            $raw['id'] = $bundling->id;
            $raw['name'] = $bundling->name;
            $raw['diskon'] = $bundling->diskon  . '%';
            $raw['harga_normal'] = array_sum($this->dataharganorma);
            $raw['hemat'] = array_sum($this->dataharganorma) * (int) $bundling->diskon / 100;
            $raw['price'] = (int)$bundling->nominal;
            $raw['item_bundling'] = $this->datanamaitem;
            array_push($this->simpandataraw, $raw);
        });

        return  [
            'data' => $this->simpandataraw
        ];
    }
}
