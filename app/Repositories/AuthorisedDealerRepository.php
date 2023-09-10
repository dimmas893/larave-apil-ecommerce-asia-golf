<?php

namespace App\Repositories;

/** use your model */
use App\Models\Brand;

class AuthorisedDealerRepository
{
    function findIndexAuthorisedDealer($perPage = 15, array $filter)
    {
        $brand = $this->queryFindIndexAuthorisedDealer($filter);
        $brand->where('is_authorized', 1);
        return $brand->paginate($perPage);

    }

    function queryFindIndexAuthorisedDealer($filter)
    {
        $brand = Brand::query();
        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $brand->where('name', 'like', $search);
        }
        return $brand;
    }

    function limit($limit = 10)
    {
        $brand = Brand::query();
        $brand->where('is_authorized', 1);
        return $brand->take($limit)->get();
        ;
    }
}