<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(CouponRepository $couponRepository)
    {
        $data = $couponRepository->listCoupon();
        return $data;
    }
}
