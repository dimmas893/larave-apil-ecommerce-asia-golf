<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Product;
use App\Repositories\CheckoutRepository;
use App\Repositories\CheckPostageRepository;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $requestmanual, CheckoutRepository $checkoutRepository, ShippingRequest $request, CheckPostageRepository  $checkPostageRepository)
    {
        // dd($requestmanual['product_id']);
        $shipping = new CheckPostageController();
        $datashipping = $shipping->shipping($request, $checkPostageRepository);
        // dd($datashipping);
        $validated = $request->validate([
            'service' => 'nullable',
            'asuransi' => 'nullable',
            'coupon_id' => 'nullable',
            'product' => 'nullable',
            'note' => 'nullable',
        ]);
        $data = $checkoutRepository->checkout($validated, $datashipping);
        return $data;
    }
}
