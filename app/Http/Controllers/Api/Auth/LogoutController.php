<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request, AuthRepository $authRepository)
    {
        return $authRepository->logout();
    }
}
