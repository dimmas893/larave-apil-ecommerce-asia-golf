<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\Product;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class ItemRepository
{
    function findIndex($perPage = 10, array $filter)
    {
        // dd('ds');
        $product = Item::query();
        $product->orderBy('created_at', 'DESC');
        return $product->paginate($perPage);
    }

    function findProdukItemindex($perPage = 10, array $filter)
    {
        $product = $this->queryFindProdukItemindex($filter);
        // $product->whereHasMorph('productable', ['App\Models\Item'], function ($query) use ($filter) {
        //     $query->where('is_bestseller', 1);
        // });
        // dd('ds');

        $product->whereHasMorph('productable', ['App\Models\Item']);
        $product->with([
            'productable.itemPhoto' => function ($queryItemPhoto) {
                $queryItemPhoto->where('is_default', 1);
            }
        ]);
        $product->orderBy('created_at', 'DESC');
        return $product->paginate($perPage);
    }

    function findIndexItemOtherOffers($perPage = 10, array $filter)
    {
        $product = $this->queryFindProdukItemindex($filter);
        $product->whereHasMorph('productable', ['App\Models\Item']);
        $product->with([
            'productable.itemPhoto' => function ($queryItemPhoto) {
                $queryItemPhoto->where('is_default', 1);
            }
        ]);
        $product->inRandomOrder();
        return $product->paginate($perPage);
    }

    function queryFindProdukItemindex($filter)
    {
        $product = Product::query();

        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $product->where('code', 'like', $search)->orWhere('name', 'like', $search);
        }
        return $product;
    }

    function limit(array $data)
    {
        $product = Product::query();
        $product->whereHasMorph('productable', ['App\Models\Item'], function ($query) use ($data) {
            $query->where('is_bestseller', 1);
        });
        $product->orderBy('created_at', 'DESC');
        $product->with([
            'productable.itemPhoto' => function ($queryItemPhoto) {
                $queryItemPhoto->where('is_default', 1);
            }
        ]);
        return $product->take($data['limit'])->get();
    }

    function limitOtherOffers(array $data)
    {
        $product = Product::query();
        $product->whereHasMorph('productable', ['App\Models\Item']);
        $product->with([
            'productable.itemPhoto' => function ($queryItemPhoto) {
                $queryItemPhoto->where('is_default', 1);
            }
        ]);
        $product->inRandomOrder();
        return $product->take($data['limit'])->get();
    }

    public function create(array $data)
    {
        $item = new Item();
        $item->number = $data["number"];
        $item->name = $data["name"];
        $item->minimal_order = $data["minimalOrder"];
        $item->is_bestseller = $data["isBestseller"] == "true" ? 1 : 0;
        $item->gender = $data["gender"];
        $item->price = $data["price"];
        $item->weight = $data["weight"];
        $item->deskripsi = $data["deskripsi"];
        $item->brand_id = $data["brandId"];
        $item->category_id = $data["categoryId"];
        $item->save();


        $items = [];
        $existingCodes = [];

        foreach ($data['itemVariants'] as $itemVariant) {
            $code = $itemVariant['code'];

            if (!in_array($code, $existingCodes)) {
                $existingCodes[] = $code;

                $items[] = new ItemVariant([
                    'item_id' => $item->id,
                    'code' => $code,
                    'name' => $itemVariant['name']
                ]);
            }
        }
        $item->itemVariant()->saveMany($items);
    }

    function detail($item)
    {
        return $item;
    }

    function update($item, array $data)
    {

        $item->number = !empty($data['number']) ? $data['number'] : $item->number;
        $item->name = !empty($data['name']) ? $data['name'] : $item->name;
        $item->minimal_order = !empty($data['minimalOrder']) ? $data['minimalOrder'] : $item->minimal_order;
        $item->is_bestseller = !empty($data['isBestseller']) ? ($data['isBestseller'] === 'true' ? 1 : 0) : $item->is_bestseller;
        $item->gender = !empty($data['gender']) ? $data['gender'] : $item->gender;
        $item->price = !empty($data['price']) ? $data['price'] : $item->price;
        $item->weight = !empty($data['weight']) ? $data['weight'] : $item->weight;
        $item->deskripsi = !empty($data['deskripsi']) ? $data['deskripsi'] : $item->deskripsi;
        $item->brand_id = !empty($data['brandId']) ? $data['brandId'] : $item->brand_id;
        $item->category_id = !empty($data['categoryId']) ? $data['categoryId'] : $item->category_id;

        $item->save();

        $items = [];
        $existingCodes = [];

        foreach ($data['itemVariants'] as $itemVariant) {
            $code = $itemVariant['code'];

            if (!in_array($code, $existingCodes)) {
                $existingCodes[] = $code;

                $items[] = new ItemVariant([
                    'item_id' => $item->id,
                    'code' => $code,
                    'name' => $itemVariant['name']
                ]);
            }
        }
        $item->itemVariant()->delete($items);
        $item->itemVariant()->saveMany($items);
    }

    function delete($item)
    {
        $item->itemVariant()->delete($item);
        return $item->delete();
    }
}
