<?php

namespace App\Repositories;

use App\Models\User;
/** use your storage */
use Illuminate\Support\Facades\Storage;

//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
    function findIndexUser($perPage = 15, array $filter)
    {
        $category = $this->queryFindIndexUser($filter);
        return $category->paginate($perPage);

    }

    function queryFindIndexUser($filter)
    {
        $category = User::query();
        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $category->where('name', 'like', $search);
        }
        return $category;
    }

    function delete($user)
    {
        Storage::disk('public')->delete($user->customer->photo);
        $user->customer()->delete($user);
        return $user->delete();
    }

    function detail($user)
    {
        return $user;
    }
}