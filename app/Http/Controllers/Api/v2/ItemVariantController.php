<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemVariantRequest;
use App\Models\ItemVariant;
use App\Repositories\ItemVariantRepository;
use Illuminate\Http\Request;

class ItemVariantController extends Controller
{
    function create(ItemVariantRequest $request, ItemVariantRepository $categorieRepository)
    {
        try {
            $categorieRepository->create($request->validated());
            return [
                'status' => "success",
                'message' => _('item variant created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(ItemVariant $itemVariant, ItemVariantRequest $request, ItemVariantRepository $itemVariantRepository)
    {
        try {
            $itemVariantRepository->update($itemVariant, $request->validated());
            return [
                'status' => "success",
                'message' => _('item variant updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(ItemVariant $itemVariant, ItemVariantRepository $itemVariantRepository)
    {
        try {
            $itemVariantRepository->delete($itemVariant);
            return [
                'status' => "success",
                'message' => _('item variant deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}