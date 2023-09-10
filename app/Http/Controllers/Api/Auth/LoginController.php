<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(LoginRequest $request, AuthRepository $authRepository)
    {
        // dd('dsd');
        return $authRepository->login($request->validated());
    }
}