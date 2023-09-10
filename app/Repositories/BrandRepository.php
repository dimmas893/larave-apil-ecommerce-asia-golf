<?php

namespace App\Repositories;

/** use Your Model */
use App\Models\Brand;
/** use your storage */
use Illuminate\Support\Facades\Storage;

class BrandRepository
{
    function findIndexBrand($perPage = 15, array $filter)
    {
        $brand = $this->queryFindIndexBrand($filter);
        return $brand->paginate($perPage);

    }

    function queryFindIndexBrand($filter)
    {
        $brand = Brand::query();
        if (!empty($filter['search'])) {
            $search = "%{$filter['search']}%";
            $brand->where('name', 'like', $search);
        }
        return $brand;
    }

    function update($brand, $request)
    {
        $data = $request->validated();
        $brand->name = !empty($data['name']) ? $data['name'] : $brand->name;
        $brand->is_authorized = !empty($data['isAuthorized']) ? ($data['isAuthorized'] === 'true' ? 1 : 0) : $brand->is_authorized;
        $brand->is_exclusive = !empty($data['isExclusive']) ? ($data['isExclusive'] === 'true' ? 1 : 0) : $brand->is_exclusive;

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($brand->logo);
            $logoBrand = Storage::disk('public')->put('brand/' . $brand->id, $request->file('logo'));
            $brand->logo = $logoBrand;
        }

        $brand->save();
    }

    function post($request)
    {
        $data = $request->validated();

        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->is_authorized = $data['isAuthorized'] === 'true' ? 1 : 0;
        $brand->is_exclusive = $data['isExclusive'] === 'true' ? 1 : 0;

        $brand->save();

        if ($request->hasFile('logo')) {
            $logoBrand = Storage::disk('public')->put('brand/' . $brand->id, $request->file('logo'));
            $brand->logo = $logoBrand;
            $brand->save();
        }
    }

    function delete($brand)
    {
        Storage::disk('public')->delete($brand->logo);
        return $brand->delete();
    }
}