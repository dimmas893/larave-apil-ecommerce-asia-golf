<?php

namespace App\Repositories;

use App\Http\Resources\v2\ItemReviewResource;
use App\Models\Item;
use App\Models\ItemReview;
use Illuminate\Database\Eloquent\Builder;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class ItemReviewRepository.
 */
class ItemReviewRepository
{
    public function itemreview($item, $dataFilter)
    {

        $dataItem = ItemReview::query();
        if (!empty($dataFilter['rating'])) {
            $search = "%{$dataFilter['rating']}%";
            $dataItem->where('rating', 'like', $search);
        }
        if (!empty($dataFilter['sort'])) {
            $search = $dataFilter['sort'];
            $dataItem->orderBy('created_at', $search);
        }
        $dataQuery =   $dataItem->where('item_id', $item->id)->get();
        return  $dataQuery != null ? ItemReviewResource::collection($dataQuery) : [];
    }
}
