<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Auth\LocalRepository;

class LogoutController extends Controller
{
    public function index( LocalRepository $repository)
    {
        $repository->logout();
        return response()->json(["success" => true]);
    }
}