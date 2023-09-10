<?php

namespace App\Repositories;

use App\Models\Cart;

//use Your Model

/**
 * Class CartRepository.
 */
class CartRepository
{
    function findIndexCart($perPage = 15, array $filter)
    {
        return Cart::where('customer_id', Auth()->user())->paginate($perPage);
    }
    public function create(array $data)
    {
        $cart = new Cart();
        $fieldCart = [
            "product_id" => $data["productId"],
            "customer_id" => Auth()->user(),
            "variant_id" => $data["variantId"],
            "qty" => $data["qty"],
        ];
        $cart->create($fieldCart);
    }

    function update($cart, array $data)
    {
        $cart->product_id = !empty($data['productId']) ? $data['productId'] : $cart->product_id;
        $cart->variant_id = !empty($data['variantId']) ? $data['variantId'] : $cart->variant_id;
        $cart->qty = !empty($data['qty']) ? $data['qty'] : $cart->qty;
        $cart->save();
    }

    function delete($cart)
    {
        return $cart->delete();
    }

    function allDelete(array $id)
    {
        $ids = collect($id['carts'])->pluck('id');
        Cart::whereIn('id', $ids)->delete();
    }
}