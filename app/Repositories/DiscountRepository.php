<?php

namespace App\Repositories;

/** use Your Model */

use App\Models\ItemDiscount;
use App\Models\Product;
use Carbon\Carbon;

/**
 * Class DiscountRepository.
 */
class DiscountRepository
{
    function findIndex($perPage = 10, array $filter)
    {
        $product = $this->queryFindIndex($filter);
        return $product->paginate($perPage);
    }

    function queryFindIndex($filter)
    {
        $toDay = Carbon::now()->Format('Y-m-d'); //tanggal hari ini
        $product = Product::query();

        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $product->where('code', 'like', $search)->orWhere('name', 'like', $search);
        }

        $product->whereHasMorph('productable', ['App\Models\Item'], function ($query) use ($toDay) {
            $query->whereHas('discount', function ($queryDiscount) use ($toDay) {
                $queryDiscount->where('type', 'flashsale')->where('end_at', '>=', $toDay)->where('start_at', '<=', $toDay);
            });
        })->with([
                    'productable' => function ($query) {
                        $query->with('discount');
                    }
                ]);

        return $product;
    }

    function limit($limit = 10)
    {
        $toDay = Carbon::now()->Format('Y-m-d'); //tanggal hari ini
        $brand = Product::query();
        $brand->whereHasMorph('productable', ['App\Models\Item'], function ($query) use ($toDay) {
            $query->whereHas('discount', function ($queryDiscount) use ($toDay) {
                $queryDiscount->where('type', 'flashsale')->where('end_at', '>=', $toDay)->where('start_at', '<=', $toDay);
            });
        });
        return $brand->take($limit)->get();
        ;
    }

    function create(array $data)
    {
        ItemDiscount::create([
            'item_id' => $data['itemId'],
            'nominal' => $data['nominal'],
            'type' => $data['type'],
            'start_at' => $data['startAt'],
            'end_at' => $data['endAt']
        ]);
    }

    function update($itemDiscount, array $data)
    {
        $itemDiscount->item_id = !empty($data['itemId']) ? $data['itemId'] : $itemDiscount->item_id;
        $itemDiscount->nominal = !empty($data['nominal']) ? $data['nominal'] : $itemDiscount->nominal;
        $itemDiscount->type = !empty($data['type']) ? $data['type'] : $itemDiscount->type;
        $itemDiscount->start_at = !empty($data['startAt']) ? $data['startAt'] : $itemDiscount->start_at;
        $itemDiscount->end_at = !empty($data['endAt']) ? $data['endAt'] : $itemDiscount->end_at;
        $itemDiscount->save();
    }

    function delete($itemDiscount)
    {
        return $itemDiscount->delete();
    }
}