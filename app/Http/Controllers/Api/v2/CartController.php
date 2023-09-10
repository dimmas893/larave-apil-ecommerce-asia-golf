<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartDeleteAllRequest;
use App\Http\Requests\CartIndexRequest;
use App\Http\Requests\CartRequest;
use App\Http\Resources\V2\CartResource;
use App\Models\Cart;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function index(CartIndexRequest $cartIndexRequest, CartRepository $cartRepository)
    {
        try {
            $filter = $cartIndexRequest->validated();
            $perPage = $filter['perPage'];
            return CartResource::collection($cartRepository->findIndexCart($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function create(CartRequest $cartRequest, CartRepository $cartRepository)
    {
        try {
            $data = $cartRequest->validated();
            $cartRepository->create($data);
            return [
                'status' => "success",
                'message' => _('cart created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(Cart $cart, CartRequest $cartRequest, CartRepository $cartRepository)
    {
        try {
            $data = $cartRequest->validated();
            $cartRepository->update($cart, $data);
            return [
                'status' => "success",
                'message' => _('cart updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    function delete(Cart $cart, CartRepository $cartRepository)
    {
        try {
            $cartRepository->delete($cart);
            return [
                'status' => "success",
                'message' => _('cart deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function allDelete(CartDeleteAllRequest $cartDeleteAllRequest, CartRepository $cartRepository)
    {
        try {
            $cartRepository->allDelete($cartDeleteAllRequest->validated());
            return [
                'status' => "success",
                'message' => _('all cart deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}