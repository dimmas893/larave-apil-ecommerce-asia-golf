<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Requests\SubdistrictRequest;
use App\Http\Resources\v2\CityResource;
use App\Http\Resources\v2\ProvinceResource;
use App\Http\Resources\v2\SubdistrictResource;
use App\Repositories\RegionRepository;
use Exception;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function subDistrict(SubdistrictRequest $subdistrictRequest, RegionRepository $regionRepository)
    {
        try {
            $data = $subdistrictRequest->validated();
            $datasubdistrict = $regionRepository->subdistrict($data);
            return new SubdistrictResource($datasubdistrict);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function city(CityRequest $cityRequest, RegionRepository $regionRepository)
    {
        try {
            $data = $cityRequest->validated();
            $datacity = $regionRepository->city($data);
            return new CityResource($datacity);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function province(RegionRepository $regionRepository)
    {
        try {
            $dataprovince = $regionRepository->province();
            return new ProvinceResource($dataprovince);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
