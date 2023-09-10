<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemBundlingIndexRequest;
use App\Http\Requests\ItemBundlingRequest;
use App\Http\Requests\LimitRequest;
use App\Http\Resources\v2\ProductResource;
use App\Models\ItemBundling;
use App\Repositories\ItemBundlingRepository;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Product;

class ItemBundlingController extends Controller
{
    function index(ItemBundlingIndexRequest $itemBundlingIndexRequest, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            $filter = $itemBundlingIndexRequest->validated();
            $perPage = $filter['perPage'];
            return ProductResource::collection($itemBundlingRepository->findIndexItemBundling($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function detail(Product $product, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            return new ProductResource($itemBundlingRepository->detailBundling($product));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function limitRelationBundling(Item $item, LimitRequest $limitRequest, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            $data = $limitRequest->validated();
            $limit = $data['limit'];
            return ProductResource::collection($itemBundlingRepository->limitRelationBundlingRepository($item, $limit));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function relationBundling(Item $item, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            return ProductResource::collection($itemBundlingRepository->relationBundlingRepository($item));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function create(ItemBundlingRequest $itemBundlingRequest, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            $itemBundlingRepository->create($itemBundlingRequest->validated());
            return [
                'status' => "success",
                'message' => _('item bundling and detail created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(ItemBundling $itemBundling, ItemBundlingRequest $itemBundlingRequest, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            $itemBundlingRepository->update($itemBundling, $itemBundlingRequest->validated());

            return [
                'status' => "success",
                'message' => _('item bundling and detail updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(ItemBundling $itemBundling, ItemBundlingRepository $itemBundlingRepository)
    {
        try {
            $itemBundlingRepository->delete($itemBundling);
            return [
                'status' => "success",
                'message' => _('item bundling and detail deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
