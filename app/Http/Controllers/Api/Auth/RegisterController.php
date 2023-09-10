<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\CustomerResource;
use App\Repositories\AuthRepository;
use App\Repositories\CustomerRepository;

class RegisterController extends Controller
{
    public function index(RegisterRequest $request, CustomerRepository $customerRepository, AuthRepository $authRepository)
    {
        try {
            // register user
            $user = $authRepository->register($request->all());
            $data = $request->except("password", "password_confirmation");
            $data["user_id"] = $user["id"];
            $customer = $customerRepository->create($data);

            // response data customer
            return response()->json([
                "data" => $customer
            ]);
        } catch (\Exception $e) {

            // handle error message
            return response()->json([
                "message" => $e->getMessage()
            ]);
        }
    }
}
