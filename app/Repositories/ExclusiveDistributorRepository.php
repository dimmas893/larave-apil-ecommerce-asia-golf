<?php

namespace App\Repositories;

/** use your model */
use App\Models\Brand;

/**
 * Class ExclusiveDistributorRepository.
 */
class ExclusiveDistributorRepository
{
    function findIndexExclusiveDistributor($perPage = 15, array $filter)
    {
        $brand = $this->queryFindIndexExclusiveDistributor($filter);
        $brand->where('is_exclusive', 1);
        return $brand->paginate($perPage);

    }

    function queryFindIndexExclusiveDistributor($filter)
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
        $brand->where('is_exclusive', 1);
        return $brand->take($limit)->get();
        ;
    }
}