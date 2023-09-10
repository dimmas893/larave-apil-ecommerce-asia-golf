<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\V2\ShippingResource;
use Illuminate\Http\JsonResponse;

/** repository */

use App\Repositories\CheckPostageRepository;

/** request */

use App\Http\Requests\ShippingRequest;

class CheckPostageController extends Controller
{
    public function shipping(ShippingRequest $request, CheckPostageRepository $checkPostageRepository)
    {
        // dd($request);
        $data = $request->validated();
        $checkPostage = $checkPostageRepository->shipping($data);

        $collection = collect($checkPostage);
        if (isset($collection['rajaongkir']['results'])) {
            return new ShippingResource($collection['rajaongkir']['results']);
        } else {
            return new JsonResponse([
                'status' => 'success',
                'message' => _('no data')
            ], 404);
        }
    }
}
