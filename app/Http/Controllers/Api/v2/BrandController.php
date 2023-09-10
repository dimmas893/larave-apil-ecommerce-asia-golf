<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
/** use your repository */
use App\Repositories\BrandRepository;
/** use your request */
use App\Http\Requests\BrandIndexRequest;
use App\Http\Requests\BrandRequest;
/** use your resource */
use App\Http\Resources\v2\BrandReResource;
/** use your model */
use App\Models\Brand;


class BrandController extends Controller
{
    function index(BrandIndexRequest $brandIndexRequest, BrandRepository $brandRepository)
    {
        try {
            $filter = $brandIndexRequest->validated();
            $perPage = $filter['perPage'];
            return BrandReResource::collection($brandRepository->findIndexBrand($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    function post(BrandRequest $request, BrandRepository $brandRepository)
    {
        try {

            $brandRepository->post($request);
            return [
                'status' => "success",
                'message' => _('brand created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(Brand $brand, BrandRequest $request, BrandRepository $brandRepository)
    {
        try {

            $brandRepository->update($brand, $request);
            return [
                'status' => "success",
                'message' => _('brand updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(Brand $brand, BrandRepository $brandRepository)
    {
        try {
            $brandRepository->delete($brand);
            return [
                'status' => "success",
                'message' => _('brand deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}