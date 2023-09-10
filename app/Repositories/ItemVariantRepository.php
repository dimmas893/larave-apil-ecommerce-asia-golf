<?php

namespace App\Repositories;

use App\Http\Resources\v2\ItemVariantResource;
use App\Models\ItemVariant;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class ItemVariantRepository.
 */
class ItemVariantRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function itemvariant($item)
    {
        return $item->itemVariant != null ? ItemVariantResource::collection($item->itemVariant) : [];
    }

    public function create(array $data)
    {
        $itemVariant = new ItemVariant();
        $fieldItemVariant = [
            "item_id" => $data["itemId"],
            "code" => $data["code"],
            "name" => $data["name"],
        ];
        $itemVariant->create($fieldItemVariant);
    }

    function update($itemVariant, array $data)
    {
        $itemVariant->code = !empty($data['code']) ? $data['code'] : $itemVariant->code;
        $itemVariant->name = !empty($data['name']) ? $data['name'] : $itemVariant->name;
        $itemVariant->item_id = !empty($data['itemId']) ? $data['itemId'] : $itemVariant->item_id;
        $itemVariant->save();
    }

    function delete($itemVariant)
    {
        return $itemVariant->delete();
    }
}