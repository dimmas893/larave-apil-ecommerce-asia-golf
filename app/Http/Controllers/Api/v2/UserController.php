<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\v2\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(UserIndexRequest $userIndexRequest, UserRepository $userRepository)
    {
        try {
            $filter = $userIndexRequest->validated();
            $perPage = $filter['perPage'];
            return UserResource::collection($userRepository->findIndexUser($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    function delete(User $user, UserRepository $userRepository)
    {
        try {
            $userRepository->delete($user);
            return [
                'status' => "success",
                'message' => _('user deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function detail(User $user, UserRepository $userRepository)
    {
        try {
            return new UserResource($userRepository->detail($user));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}