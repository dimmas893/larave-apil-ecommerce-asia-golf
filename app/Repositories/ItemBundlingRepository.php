<?php

namespace App\Repositories;

use App\Http\Resources\v2\ItemBundlingResource;
use App\Models\ItemBundling;
use App\Models\ItemBundlingDetails;
use App\Models\Product;

//use Your Model

/**
 * Class ItemBundlingRepository.
 */
class ItemBundlingRepository
{
    public function detailBundling($product)
    {
        return $product;
    }

    function findIndexItemBundling($perPage = 10, array $filter)
    {
        $product = $this->queryFindIndexItemBundling($filter);
        $product->orderBy('created_at', 'DESC');
        return $product->paginate($perPage);
    }

    function queryFindIndexItemBundling($filter)
    {
        $product = Product::query();
        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $product->where('code', 'like', $search)->orWhere('name', 'like', $search);
        }
        $product->whereHasMorph('productable', ['App\Models\ItemBundling']);
        return $product;
    }

    public function relationBundlingRepository($item, $limit = 10)
    {

        $itemBundling = Product::query();
        $itemBundling->whereHas('productable', function ($query) use ($item) {
            $query->whereHas('itemBundlingDetails', function ($q) use ($item) {
                $q->where('item_id', $item->id);
            });
        })->with('productable');
        return $itemBundling->get();


        // ItemBundling::whereHas('itemBundlingDetails', function ($q) use ($item) {
        //     $q->where('item_id', $item->id);
        // })->get();
        // dd($itemBundling);
        // return ItemBundlingResource::collection($itemBundling);
    }

    public function limitRelationBundlingRepository($item, $limit = 10)
    {

        $itemBundling = Product::query();
        $itemBundling->whereHas('productable', function ($query) use ($item) {
            $query->whereHas('itemBundlingDetails', function ($q) use ($item) {
                $q->where('item_id', $item->id);
            });
        })->with('productable');
        return $itemBundling->take($limit)->get();


        // ItemBundling::whereHas('itemBundlingDetails', function ($q) use ($item) {
        //     $q->where('item_id', $item->id);
        // })->get();
        // dd($itemBundling);
        // return ItemBundlingResource::collection($itemBundling);
    }

    function create(array $data)
    {
        $dataBundling = [
            'name' => $data['name'],
            'price' => $data['price'],
            'saving' => $data['saving']
        ];
        $itemBundling = ItemBundling::create($dataBundling);


        $bundlingItems = []; // Ubah nama variabel agar tidak konflik

        foreach ($data['item'] as $bundlingItem) {
            $bundlingItems[] = new ItemBundlingDetails([
                'item_bundling_id' => $itemBundling->id,
                'item_id' => $bundlingItem['id']
            ]);
        }
        $itemBundling->itemBundlingDetails()->saveMany($bundlingItems);
    }

    function delete($itemBundling)
    {
        $itemBundling->product()->delete();
        $itemBundling->delete();
        $itemBundling->itemBundlingDetails()->delete();
    }

    function update($itemBundling, array $data)
    {
        $dataBundling = [];

        if (!empty($data['name'])) {
            $dataBundling['name'] = $data['name'];
        }

        if (!empty($data['price'])) {
            $dataBundling['price'] = $data['price'];
        }

        if (!empty($data['saving'])) {
            $dataBundling['saving'] = $data['saving'];
        }

        $itemBundling->update($dataBundling);

        if (!empty($data['saving'])) {
            $bundlingItems = []; // Ubah nama variabel agar tidak konflik

            foreach ($data['item'] as $bundlingItem) {
                $bundlingItems[] = new ItemBundlingDetails([
                    'item_bundling_id' => $itemBundling->id,
                    'item_id' => $bundlingItem['id']
                ]);
            }

            $itemBundling->itemBundlingDetails()->delete($bundlingItems);
            $itemBundling->itemBundlingDetails()->saveMany($bundlingItems);
        }
    }
}