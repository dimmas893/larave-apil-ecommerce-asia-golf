<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\WishlistItemResource;
use App\Repositories\WishlistRepository;
use Illuminate\Http\Request;

use App\Http\Requests\WishlistIndexRequest;
use App\Http\Requests\WishlistRequest;
use App\Models\DiscountItem;
use App\Models\DiscountItemVarian;
use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\MetaItem;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;

// use Exception;

class WishlistController extends Controller
{
    public function index(WishlistIndexRequest $wishlistIndexRequest, WishlistRepository $wishlistRepository)
    {
        try {
            $filter = $wishlistIndexRequest->validated();
            $perPage = $filter['perPage'];
            return WishlistItemResource::collection($wishlistRepository->findIndex($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create($product, WishlistRepository $wishlistRepository)
    {
        try {
            $wishlist = $wishlistRepository->create($product);
            return [
                'status' => 'success',
                'message' => _($wishlist)
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($product, WishlistRepository $wishlistRepository)
    {
        try {
            $wishlist = $wishlistRepository->delete($product);
            return [
                'status' => 'success',
                'message' => _($wishlist)
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
