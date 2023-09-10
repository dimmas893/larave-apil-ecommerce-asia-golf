<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AuthRepository;
use App\Repositories\CustomerRepository;

class CurrentUserController extends Controller
{
    public function index(Request $request, AuthRepository $authRepository, CustomerRepository $customerRepository)
    {
        $userId = Auth::user()->id;
        $customer = $customerRepository->getByColumn($userId, "user_id");
        return new CustomerResource($customer);
    }
}
