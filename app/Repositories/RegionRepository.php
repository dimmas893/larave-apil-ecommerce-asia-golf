<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class RegionRepository.
 */
class RegionRepository
{
    public function subdistrict($city)
    {
        $datacity = (int)$city;
        $response = Http::withHeaders([
            'key' => 'ae91f7b2f38c5da665525ce2bf62b2b6'
        ])->get('https://pro.rajaongkir.com/api/subdistrict?city=' . $datacity . '');
        $array = $response->getBody()->getContents();
        $json = json_decode($array, true);
        $collection = collect($json);
        if (isset($collection['rajaongkir']['results'])) {
            $data = $collection['rajaongkir']['results'];
            return $data;
        } else {
            return new JsonResponse([
                'status' => 'success',
                'message' => _('no data')
            ], 404);
        }
    }

    public function city($province)
    {
        $dataprovince = (int)$province;
        $response = Http::withHeaders([
            'key' => 'ae91f7b2f38c5da665525ce2bf62b2b6',
        ])->get('https://pro.rajaongkir.com/api/city?province=' . $dataprovince);
        $array = $response->getBody()->getContents();
        $json = json_decode($array, true);
        $collection = collect($json);
        if (isset($collection['rajaongkir']['results'])) {
            $data = $collection['rajaongkir']['results'];
            return $data;
        } else {
            return new JsonResponse([
                'status' => 'success',
                'message' => _('no data')
            ], 404);
        }
    }

    public function province()
    {
        $response = Http::withHeaders([
            'key' => 'ae91f7b2f38c5da665525ce2bf62b2b6'
        ])->get('https://pro.rajaongkir.com/api/province');
        $array = $response->getBody()->getContents();
        $json = json_decode($array, true);
        $collection = collect($json);
        if (isset($collection['rajaongkir']['results'])) {
            $data = $collection['rajaongkir']['results'];
            return $data;
        } else {
            return new JsonResponse([
                'status' => 'success',
                'message' => _('no data')
            ], 404);
        }
    }
}
