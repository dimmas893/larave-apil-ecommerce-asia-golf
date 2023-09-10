<?php

namespace App\Repositories;

use App\Http\Resources\v2\ItemMetaResource;
use App\Http\Resources\v2\MetaItemResource;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ItemMetaRepository.
 */
class ItemMetaRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function itemmeta($item)
    {
        return new ItemMetaResource($item->itemMeta);
    }
}
