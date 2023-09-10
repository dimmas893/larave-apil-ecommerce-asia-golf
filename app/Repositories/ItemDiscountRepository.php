<?php

namespace App\Repositories;

use App\Http\Resources\v2\ItemDiscountResource;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ItemDiscountRepository.
 */
class ItemDiscountRepository
{
    public function itemdiscount($item)
    {
        return new ItemDiscountResource($item->itemDiscount);
    }
}
