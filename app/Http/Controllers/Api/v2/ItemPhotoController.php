<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemPhotoRequest;
use App\Models\ItemPhoto;
use App\Repositories\ItemPhotoRepository;
use Illuminate\Http\Request;

class ItemPhotoController extends Controller
{
    function create(ItemPhotoRequest $request, ItemPhotoRepository $itemPhotoRepository)
    {
        try {

            $returnitemPhotoRepository = $itemPhotoRepository->create($request);
            return [
                'status' => "success",
                'message' => _($returnitemPhotoRepository),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(ItemPhoto $itemPhoto, ItemPhotoRequest $request, ItemPhotoRepository $itemPhotoRepository)
    {
        try {
            // return $itemPhoto;
            $returnitemPhotoRepository = $itemPhotoRepository->update($itemPhoto, $request);
            return [
                'status' => "success",
                // 'message' => _($returnitemPhotoRepository),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(ItemPhoto $itemPhoto, ItemPhotoRepository $itemPhotoRepository)
    {
        try {
            $itemPhotoRepository->delete($itemPhoto);
            return [
                'status' => "success",
                'message' => _('item photo deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}