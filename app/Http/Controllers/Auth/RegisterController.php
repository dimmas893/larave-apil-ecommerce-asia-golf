<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Auth\LocalRepository;
use App\Http\Resources\Auth\RegisterResource;

class RegisterController extends Controller
{
    public function index(RegisterRequest $request, LocalRepository $repository)
    {

        try {
            $data = $request->validated();
            $repository->register($data);
            return [
                'status' => "success",
                'message' => _('register created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
        // return new RegisterResource($token);
    }
}