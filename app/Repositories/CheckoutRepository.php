<?php

namespace App\Repositories;

use App\Http\Controllers\Api\v2\CheckPostageController;
use App\Http\Resources\v2\ItemDiscountResource;
use App\Http\Resources\v2\ProductResource;
use App\Models\Coupon;
use App\Models\ItemDiscount;
use App\Models\Product;
use Illuminate\Http\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

class CheckoutRepository
{
    public function checkout(array $validated, $datashipping)
    {
        // dd($validated['product']);
        $simpanDataproduct = [];
        $totalHargaProduct = [];
        foreach ($validated['product'] as $product) {
            $dataProduct = Product::with('productable')->where('id', $product['id'])->firstOrFail();
            $pro['product'] = new ProductResource($dataProduct);
            if ($dataProduct->productable_type === 'App\Models\ItemBundling') {
                $total =  $pro['product']['productable']['price'] * $product['qty'];
            } else {
                if ($dataProduct->productable->itemDiscount != null) {
                    $pro['discount'] = new ItemDiscountResource($dataProduct->productable->itemDiscount);
                } else {
                    $pro['discount'] = false;
                }

                if ($pro['discount'] != false) {
                    $total =  $pro['product']['productable']['price'] * $product['qty'] - $pro['discount']['nominal'] * $product['qty'];
                } else {
                    if ($dataProduct->productable_type === 'App\Models\ItemVariant') {
                        $total =  $pro['product']['productable']['item']['price'] * $product['qty'];
                    } else {
                        $total =  $pro['product']['productable']['price'] * $product['qty'];
                    }
                }
            }

            array_push($totalHargaProduct, $total);
            array_push($simpanDataproduct, $pro);
        }

        $datacosts = [];
        $totalbiaya = [];
        foreach ($datashipping as $p) {
            foreach ($p['costs'] as $pe) {
                if (isset($validated['service'])) {
                    if ($pe['service'] === $validated['service']) {
                        foreach ($pe['cost'] as $cost) {
                            array_push($totalbiaya, $cost['value']);
                        }
                        array_push($datacosts, $p);
                    }
                }
            }
        }
        // dd($totalbiaya);
        if (isset($validated['asuransi'])) {
            $asuransi = $validated['asuransi'];
        } else {
            $asuransi = 0;
        }

        if (isset($validated['coupon_id'])) {;
            $coupon = Coupon::where('id', $validated['coupon_id'])->firstOrFail()->nominal;
        } else {
            $coupon = 0;
        }
        // dd(array_sum($totalHargaProduct));
        $biayaProduct = array_sum($totalHargaProduct) + array_sum($totalbiaya) +  $asuransi - $coupon;
        return [
            'data' => $simpanDataproduct,
            'total' => $biayaProduct,
            'note' => $validated['note']
        ];
    }
}
