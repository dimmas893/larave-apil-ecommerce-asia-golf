<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieIndexRequest;
use App\Http\Requests\CategorieRequest;
use App\Http\Resources\v2\CategorieResource;
use App\Models\Category;
use App\Repositories\CategorieRepository;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    function index(CategorieIndexRequest $categorieIndexRequest, CategorieRepository $categorieRepository)
    {
        try {
            $filter = $categorieIndexRequest->validated();
            $perPage = $filter['perPage'];
            return CategorieResource::collection($categorieRepository->findIndexCategorie($perPage, $filter));
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    function post(CategorieRequest $request, CategorieRepository $categorieRepository)
    {
        try {
            $categorieRepository->create($request->validated());
            return [
                'status' => "success",
                'message' => _('categorie created'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function update(Category $categorie, CategorieRequest $request, CategorieRepository $categorieRepository)
    {
        try {
            $categorieRepository->update($categorie, $request->validated());
            return [
                'status' => "success",
                'message' => _('categorie updated'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function delete(Category $categorie, CategorieRepository $categorieRepository)
    {
        try {
            $categorieRepository->delete($categorie);
            return [
                'status' => "success",
                'message' => _('categorie deleted'),
            ];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}