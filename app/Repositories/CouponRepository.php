<?php

namespace App\Repositories;

use App\Http\Resources\v2\CouponResource;
use App\Models\Coupon;
use App\Models\Customer;
use Carbon\Carbon;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CouponRepository.
 */
class CouponRepository
{
    public function listCoupon()
    {
        $toDay = Carbon::now()->Format('Y-m-d'); //tanggal hari ini
        $user_id = Auth()->user()->id;
        $customer = Customer::where('user_id', $user_id)->firstOrFail();
        $coupon = Coupon::where('customer_id', $customer->id)->where('end_at', '>=', $toDay)->where('start_at', '<=', $toDay)->get();
        return couponResource::collection($coupon);
    }
}
