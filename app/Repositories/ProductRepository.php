<?php

namespace App\Repositories;

use App\Http\Resources\v2\ItemBundlingResource;
use App\Models\ItemBundling;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/** use Your Model */

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductRepository
{
    function createItem($item, array $data)
    {
        $itemProductable = $item->product;
        return $this->findCreate($itemProductable, $item, $data);
    }
    function createVariant($itemVariant, array $data)
    {
        $itemProductable = $itemVariant->product;
        return $this->findCreate($itemProductable, $itemVariant, $data);
    }

    function createBundling($itemBundling, array $data)
    {
        $itemProductable = $itemBundling->product;
        return $this->findCreate($itemProductable, $itemBundling, $data);
    }

    function findCreate($itemProductable, $item, $data)
    {
        if (isset($itemProductable)) {
            $message = "product already exists";
        } else {
            $item->product()->create([
                'code' => $data['code'],
                'name' => $item->name,
            ]);

            $message = "product created";
        }

        return $message;
    }

    function findIProduct($perPage = 15, array $filter)
    {
        $products = $this->queryFindProduct($filter);
        $products->orderBy('created_at', 'DESC');
        return $products->paginate($perPage);
    }

    public function queryFindProduct(array $filter)
    {
        $product = Product::query();
        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $product->where('code', 'like', $search)->orWhere('name', 'like', $search);
        }

        // if (!empty($filter['sort'])) {
        //     $search = $filter['sort'];
        //     $product->orderBy('created_at', $search);
        // }
        // if (!empty($filter['bestseller'])) {
        //     $search = $filter['bestseller'];
        //     $product->whereHas('item', function (Builder $query) use ($search) {
        //         $query->where('is_bestseller', $search);
        //     });
        // }

        // if (!empty($filter['random'])) {
        //     if ($filter['random'] === 'true') {
        //         $product->whereHas('item', function (Builder $query) {
        //             $query->inRandomOrder();
        //         });
        //     }
        // }
        $product->with('productable');
        return $product;
    }



    // function findItemVariantlatest($perPage = 10, array $filter)
    // {
    //     $products = $this->queryFindItemVariantlatest($filter);
    //     return $products->paginate($perPage);
    // }

    // public function queryFindItemVariantlatest(array $filter)
    // {
    //     $product = Product::query();
    //     if (!empty($filter['search'])) {
    //         $search = "%{$filter['search']}%";
    //         $product->where('code', 'like', $search)->orWhere('name', 'like', $search);
    //     }
    //     $product->with('productable')->orderBy('created_at', 'DESC');;
    //     return $product;
    // }

    // function findItemVariantbestseller($perPage = 10, array $filter)
    // {
    //     $products = $this->queryFindItemVariantbestseller($filter);
    //     return $products->paginate($perPage);
    // }

    // public function queryFindItemVariantbestseller(array $filter)
    // {
    //     $product = Product::query();
    //     if (!empty($filter['search'])) {
    //         $search = "%{$filter['search']}%";
    //         $product->where('code', 'like', $search)->orWhere('name', 'like', $search);
    //     }
    //     $product->with('productable');
    //     return $product;
    // }

    function delete($product)
    {
        $product->delete();
    }

    function details($product)
    {
        $products = Product::with('productable')->find($product->id);
        return $products;
    }

    function update($product, $validated)
    {
        $products = Product::with('productable')->find($product->id);
        $products->update([
            'name' => $validated['name']
        ]);
        return $products;
    }
}