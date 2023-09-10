<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemIndexRequest;
use App\Http\Requests\LimitItemRequest;
use App\Http\Requests\LimitRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\v2\ItemResource;
use App\Http\Resources\v2\ProductResource;
use App\Http\Resources\v2\home\ProductResource as ProductEcomResource;
use App\Repositories\ItemRepository;
use App\Models\Item;

class ItemController extends Controller
{
    function index(ItemIndexRequest $itemIndexRequest, ItemRepository $itemRepository)
    {
        try {
            $filter = $itemIndexRequest->validated();
            $perPage = $filter['perPage'];
            return ItemResource::collection($itemRepository->findIndex($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function ProdukItemindex(ItemIndexRequest $itemIndexRequest, ItemRepository $itemRepository)
    {
        try {
            $filter = $itemIndexRequest->validated();
            $perPage = $filter['perPage'];
            return ProductEcomResource::collection($itemRepository->findProdukItemindex($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function limit(LimitItemRequest $limitRequest, ItemRepository $itemRepository)
    {
        try {
            $data = $limitRequest->validated();
            return ProductEcomResource::collection($itemRepository->limit($data));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function otherOffers(ItemIndexRequest $itemIndexRequest, ItemRepository $itemRepository)
    {
        try {
            $filter = $itemIndexRequest->validated();
            $perPage = $filter['perPage'];
            return ProductEcomResource::collection($itemRepository->findIndexItemOtherOffers($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function limitOtherOffers(LimitItemRequest $limitRequest, ItemRepository $itemRepository)
    {
        try {
            $data = $limitRequest->validated();
            return ProductEcomResource::collection($itemRepository->limitOtherOffers($data));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function create(ItemRequest $itemRequest, ItemRepository $itemRepository)
    {
        try {
            $data = $itemRequest->validated();
            $product = $itemRepository->create($data);
            return [
                'status' => 'success',
                'message' => _('item created')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function detail(Item $item, ItemRepository $itemRepository)
    {
        try {
            return new ItemResource($itemRepository->detail($item));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(Item $item, ItemRequest $request, ItemRepository $itemRepository)
    {
        try {
            $itemRepository->update($item, $request->validated());
            return [
                'status' => "success",
                'message' => _('item updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(Item $item, ItemRepository $itemRepository)
    {
        try {
            $itemRepository->delete($item);
            return [
                'status' => "success",
                'message' => _('item deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
