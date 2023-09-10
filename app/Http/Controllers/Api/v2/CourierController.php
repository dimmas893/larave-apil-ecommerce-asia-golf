<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\CourierResource;
use App\Repositories\CourierRepository;
use Exception;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function courier(CourierRepository $courierRepository)
    {
        try {
            $dataprovince = $courierRepository->courier();
            return new CourierResource($dataprovince);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
