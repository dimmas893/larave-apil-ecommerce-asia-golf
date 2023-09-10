<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscussionRequest;
use App\Http\Requests\ItemReviewRequest;

/** use your repository */

use App\Http\Requests\ProductIndexRequest;
use App\Repositories\ProductRepository;

/** use your model */

use App\Models\Product;
use App\Models\Item;
use App\Models\ItemVariant;
use App\Models\ItemBundling;

/** use your resource */

use App\Http\Resources\v2\ProductResource;

/** use your request */

use App\Http\Requests\ProductRequest;
use App\Http\Resources\v2\BundlingResource;
use App\Http\Resources\v2\DiscussionResource;
use App\Http\Resources\v2\ItemMetaResource;
use App\Models\Discussion;
use App\Repositories\DiscussionRepository;
use App\Repositories\ItemDiscountRepository;
use App\Repositories\ItemMetaRepository;
use App\Repositories\ItemPhotoRepository;
use App\Repositories\ItemReviewRepository;
use App\Repositories\ItemVariantRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(ProductIndexRequest $productIndexRequest, ProductRepository $productRepository)
    {
        try {
            $filter = $productIndexRequest->validated();
            $perPage = $filter['perPage'];
            return ProductResource::collection($productRepository->findIProduct($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function createItem(Item $item, ProductRequest $productRequest, ProductRepository $productRepository)
    {
        try {
            $data = $productRequest->validated();
            $product = $productRepository->createItem($item, $data);
            return [
                'status' => 'success',
                'message' => _($product)
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function createVariant(ItemVariant $itemVariant, ProductRequest $productRequest, ProductRepository $productRepository)
    {
        try {
            $data = $productRequest->validated();
            $product = $productRepository->createVariant($itemVariant, $data);
            return [
                'status' => 'success',
                'message' => _($product)
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function createBundling(ItemBundling $itemBundling, ProductRequest $productRequest, ProductRepository $productRepository)
    {
        try {
            $data = $productRequest->validated();
            $product = $productRepository->createBundling($itemBundling, $data);
            return [
                'status' => 'success',
                'message' => _($product)
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(Product $product, ProductRepository $productRepository)
    {
        try {
            $product = $productRepository->delete($product);
            return [
                'status' => 'success',
                'message' => _('product deleted')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function details(Product $product, ProductRepository $productRepository)
    {
        try {
            return new ProductResource($productRepository->details($product));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    function update(Product $product, ProductRepository $productRepository, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        try {
            return new ProductResource($productRepository->update($product, $validated));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function discussion(Item $item, DiscussionRepository $discussionRepository)
    // {
    //     try {
    //         return $discussionRepository->discussion($item);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function itemreview(Item $item, ItemReviewRequest $itemReviewRequest, ItemReviewRepository $itemReviewRepository)
    // {
    //     try {
    //         return $itemReviewRepository->itemreview($item);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    // public function itemreview(Item $item, ItemReviewRepository $itemReviewRepository, ItemReviewRequest $itemReviewRequest)
    // {
    //     try {
    //         $filter = $itemReviewRequest->validated();
    //         $dataFilter = $filter;
    //         return $itemReviewRepository->itemreview($item, $dataFilter);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function itemphoto(Item $item, ItemPhotoRepository $itemPhotoRepository)
    // {
    //     try {
    //         return $itemPhotoRepository->itemphoto($item);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function itemvariant(Item $item, ItemVariantRepository $itemVariantRepository)
    // {
    //     try {
    //         return $itemVariantRepository->itemvariant($item);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function itemmeta(Item $item, ItemMetaRepository $itemMetaRepository)
    // {
    //     try {
    //         return $itemMetaRepository->itemmeta($item);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
    // public function itemdiscount(Item $item, ItemDiscountRepository $itemDiscountRepository)
    // {
    //     try {
    //         return $itemDiscountRepository->itemdiscount($item);
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}