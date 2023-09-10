<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
/** use your request */
use App\Http\Requests\DiscountIndexRequest;
/** use your repository */
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\LimitRequest;
use App\Http\Resources\v2\ProductResource;
use App\Models\Item;
use App\Models\ItemDiscount;
use App\Repositories\DiscountRepository;
use App\Http\Resources\v2\home\ProductResource as ProductEcomResource;


class DiscountController extends Controller
{
    function index(DiscountIndexRequest $discountIndexRequest, DiscountRepository $discountRepository)
    {
        try {
            $filter = $discountIndexRequest->validated();
            $perPage = $filter['perPage'];
            return ProductEcomResource::collection($discountRepository->findIndex($perPage, $filter));


        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function limit(LimitRequest $limitRequest, DiscountRepository $discountRepository)
    {
        try {
            $data = $limitRequest->validated();
            $limit = $data['limit'];
            return ProductEcomResource::collection($discountRepository->limit($limit));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function create(DiscountRequest $discountRequest, DiscountRepository $discountRepository)
    {
        try {
            $discountRepository->create($discountRequest->validated());
            return [
                'status' => 'success',
                'message' => _('discount created')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(DiscountRequest $discountRequest, ItemDiscount $itemDiscount, DiscountRepository $discountRepository)
    {
        try {
            $discountRepository->update($itemDiscount, $discountRequest->validated());
            return [
                'status' => 'success',
                'message' => _('discount updated')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(ItemDiscount $itemDiscount, DiscountRepository $discountRepository)
    {
        try {
            $discountRepository->delete($itemDiscount);
            return [
                'status' => 'success',
                'message' => _('discount deleted')
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}