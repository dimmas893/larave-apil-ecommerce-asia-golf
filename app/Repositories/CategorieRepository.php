<?php

namespace App\Repositories;

use App\Models\Category;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class CategorieRepository.
 */
class CategorieRepository
{
    function findIndexCategorie($perPage = 15, array $filter)
    {
        $category = $this->queryFindIndexCategorie($filter);
        return $category->paginate($perPage);

    }

    function queryFindIndexCategorie($filter)
    {
        $category = Category::query();
        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $category->where('name', 'like', $search);
        }
        return $category;
    }
    public function create(array $data)
    {
        $category = new Category();
        $fieldCategory = [
            "name" => $data["name"],
            "structure" => $data["structure"]
        ];
        $category->create($fieldCategory);
    }

    function update($categorie, array $data)
    {
        $categorie->name = !empty($data['name']) ? $data['name'] : $categorie->name;
        $categorie->structure = !empty($data['structure']) ? $data['structure'] : $categorie->structure;
        $categorie->save();
    }

    function delete($categorie)
    {
        return $categorie->delete();
    }
}