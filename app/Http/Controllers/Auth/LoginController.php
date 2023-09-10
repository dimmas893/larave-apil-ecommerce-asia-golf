<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\LocalRepository;
use App\Http\Resources\Auth\LoginResource;

class LoginController extends Controller
{
    public function index(LoginRequest $request, LocalRepository $repository)
    {
        $data = $request->validated();

        if (auth()->attempt($data)) {
            $user = auth()->user();

            if ($user->status == 'active') {
                return [
                    'status' => 'success',
                    'message' => _('Authenticated'),
                    'data' => [
                        'token' => $user->createToken('myAppToken')->plainTextToken
                    ]
                ];
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => _('akun not active'),
                    'data' => []
                ], 401);
            }
        }
        return response()->json([
            'status' => 'failed',
            'message' => _('Unauthorized'),
            'data' => []
        ], 401);


        // $token = $repository->login($data);
        // return $token;
        // return new LoginResource($token);
    }
}
