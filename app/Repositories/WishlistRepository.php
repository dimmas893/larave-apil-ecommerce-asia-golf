<?php

namespace App\Repositories;

use App\Models\Customer;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/** use Your Model */

use App\Models\Item;
use App\Models\Wishlist;

/** use Your Carbon Date */

use Carbon\Carbon;

class WishlistRepository
{
    public function findIndex($perPage = 10, $filter)
    {
        $customer = Customer::where('user_id', Auth()->user())->firstOrFail();
        $todayDate = Carbon::now()->Format('Y-m-d'); //tanggal hari ini
        $wishlist = $this->queryFindIndexWishList($filter, $todayDate);
        $wishlist->where('customer_id', $customer->id);
        return $wishlist->paginate($perPage);
    }

    public function queryFindIndexWishList(array $filter, $todayDate)
    {
        $wishlist = Wishlist::query();

        // if (!empty($filter['search'])) {
        //     $search = "%{$filter['search']}%";
        //     $wishlist->where(function ($query) use ($search) {
        //         $query->whereHas('item', function ($queryItem) use ($search) {
        //             $queryItem->where('number', 'like', $search);
        //             $queryItem->where('name', 'like', $search);
        //             $queryItem->orWhere('kondisi', 'like', $search);
        //             $queryItem->orWhere('gender', 'like', $search);
        //             $queryItem->orWhere('harga', 'like', $search);
        //         })->orWhereHas('item.itemVariant', function ($queryItemVariant) use ($search) {
        //             $queryItemVariant->where('name', 'like', $search);
        //         });
        //     });
        // }
        // dd($wishlist->product->productable_type);
        // if ($wishlist->product->productable_type === 'App\Models\Item') {
        //     if (!empty($filter['search'])) {
        //         $search = "%{$filter['search']}%";
        //         $wishlist->where(function ($query) use ($search) {
        //             $query->whereHas('item', function ($queryItem) use ($search) {
        //                 $queryItem->where('number', 'like', $search);
        //                 $queryItem->where('name', 'like', $search);
        //                 $queryItem->orWhere('kondisi', 'like', $search);
        //                 $queryItem->orWhere('gender', 'like', $search);
        //                 $queryItem->orWhere('harga', 'like', $search);
        //             })->orWhereHas('item.itemVariant', function ($queryItemVariant) use ($search) {
        //                 $queryItemVariant->where('name', 'like', $search);
        //             });
        //         });
        //     }
        // }
        // if ($wishlist->product->productable_type === 'App\Models\ItemBundling') {
        //     if (!empty($filter['search'])) {
        //         $search = "%{$filter['search']}%";
        //         $wishlist->where(function ($query) use ($search) {
        //             $query->whereHas('product', function ($product)  use ($search) {
        //                 $product->whereHas('item', function ($queryItem) use ($search) {
        //                     $queryItem->where('number', 'like', $search);
        //                     $queryItem->where('name', 'like', $search);
        //                     $queryItem->orWhere('kondisi', 'like', $search);
        //                     $queryItem->orWhere('gender', 'like', $search);
        //                     $queryItem->orWhere('harga', 'like', $search);
        //                 })->orWhereHas('item.itemVariant', function ($queryItemVariant) use ($search) {
        //                     $queryItemVariant->where('name', 'like', $search);
        //                 });
        //             });
        //         });
        //     }
        // }
        // if ($wishlist->product->productable_type === 'App\Models\ItemVariant') {
        // }

        $wishlist->with([
            'product' => function ($query) {
                $query->with([
                    'productable' => function ($queryItemVariant) {
                        $queryItemVariant->orderBy('created_at', 'DESC');
                    }
                ]);
            }
        ]);



        return $wishlist;
    }

    function create($product)
    {
        // dd($product);
        $customer = Customer::where('user_id', Auth()->user())->firstOrFail();
        $wishlist = Wishlist::where('product_id', $product)->where('customer_id', $customer->id)->firstOrFail();
        if ($wishlist) {
            $message = "wishlist already exists";
        } else {

            Wishlist::create([
                'customer_id' => $customer->id,
                'product_id' => (int) $product
            ]);
            $message = "wishlist created";
        }
        return $message;
    }

    function delete($product)
    {
        $wishlist = Wishlist::find($product);
        if ($wishlist) {
            $wishlist->delete();
            $message = "wishlist deleted";
        } else {
            $message = "data doesnt exist";
        }
        return $message;
    }
}
