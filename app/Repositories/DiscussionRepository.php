<?php

namespace App\Repositories;

use App\Http\Resources\v2\DiscussionResource;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class DiscussionRepository.
 */
class DiscussionRepository
{
    public function discussion($item)
    {
        return $item->discussion != null ? DiscussionResource::collection($item->discussion) : [];
    }
}
