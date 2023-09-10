<?php

namespace App\Repositories;


/** config */
use Config as config;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UserResource;

class AuthRepository
{
    public function register(array $data)
    {
        $response = Http::withHeaders([
            "Accept" => "application/json"
        ])
            ->post(config("services.auth.base_url") . "/register", $data);

        return new UserResource(@$response->json()['data']);
    }

    public function login(array $data)
    {
        $response = Http::withHeaders([
            "Accept" => "application/json"
        ])
            ->post(config("services.auth.base_url") . "/login", $data);
        return $response->json();
    }


    public function logout()
    {
        return response()->json([
            "success" => true
        ]);
    }
}