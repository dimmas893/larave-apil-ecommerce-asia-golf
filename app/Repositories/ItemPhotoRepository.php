<?php

namespace App\Repositories;

use App\Models\ItemPhoto;
use Illuminate\Support\Facades\Storage;

//use Your Model

/**
 * Class ItemPhotoRepository.
 */
class ItemPhotoRepository
{
    function create($request)
    {
        $data = $request->validated();
        $filterItemPhoto = ItemPhoto::where('item_variant_id', $data['itemVariantId'])->first();
        if (!$filterItemPhoto) {
            $this->findImageItem($request, $data);
            return "item photo created";
        } else {
            return "The item photo for the variant already exists, please update first";
        }
    }

    function findImageItem($request, $data)
    {
        $itemPhoto = new ItemPhoto();
        $itemPhoto->item_id = $data['itemId'];
        $itemPhoto->item_variant_id = $data['itemVariantId'];
        $itemPhoto->is_default = 0;

        $itemPhoto->save();

        if ($request->hasFile('fileName')) {
            $fileNameItemImage = Storage::disk('public')->put('itemPhoto/' . $itemPhoto->id, $request->file('fileName'));
            $itemPhoto->filename = $fileNameItemImage;
            $itemPhoto->save();
        }
    }

    function update($itemPhoto, $request)
    {
        $data = $request->validated();
        $itemPhoto->item_variant_id = !empty($data['itemVariantId']) ? $data['itemVariantId'] : $itemPhoto->item_variant_id;

        if ($request->hasFile('fileName')) {
            Storage::disk('public')->delete($itemPhoto->filename);
            $fileNameItemImage = Storage::disk('public')->put('itemPhoto/' . $itemPhoto->id, $request->file('fileName'));
            $itemPhoto->filename = $fileNameItemImage;
        }

        $itemPhoto->save();
    }

    function delete($itemPhoto)
    {
        Storage::disk('public')->delete($itemPhoto->filename);
        return $itemPhoto->delete();
    }
}
