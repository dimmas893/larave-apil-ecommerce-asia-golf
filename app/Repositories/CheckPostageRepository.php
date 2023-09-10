<?php

namespace App\Repositories;

/** config */

use Config as config;

class CheckPostageRepository
{
    public function shipping(array $data)
    {
        $curl = curl_init();
        $env = env('RAJAONGKIR');
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => config('services.rajaOngkir.APP_RAJAONGKIR'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => 'origin=501&originType=city&destination=' . $data['city'] . '&destinationType=subdistrict&weight=' . $data['weight'] . '&courier=' . $data['courier'] . '',
                CURLOPT_HTTPHEADER => array(
                    config('services.rajaOngkir.APP_TYPE'),
                    // "key: '.$env.'"
                    config('services.rajaOngkir.APP_SECRET')
                ),
            )
        );
        $response = curl_exec($curl);

        return $json = json_decode($response, true);
    }
}
