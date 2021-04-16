<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\PropertyCategoryRequest;
use App\Http\Resources\Product\PropertyCategoryResource;
use App\Models\Product\PropertyCategory;
use App\Http\Queries\Product\PropertyCategoryQuery;

class PropertyCategoryController extends Controller
{
    public function index(Request $request, PropertyCategoryQuery $propertyCategoryQuery)
    {
        $categories = $propertyCategoryQuery->paginate(config('app.page_size'));
        return PropertyCategoryResource::collection($categories);
    }

    public function store(PropertyCategoryRequest $request, PropertyCategory $propertyCategory)
    {
        $propertyCategory->fill($request->all());
        $propertyCategory->save();
        return response(null, 201);
    }

    public function show($id, PropertyCategoryQuery $propertyCategoryQuery)
    {
        $propertyCategory = $propertyCategoryQuery->findOrFail($id);
        return new PropertyCategoryResource($propertyCategory);
    }

    public function update(PropertyCategoryRequest $request, PropertyCategory $propertyCategory)
    {
        $propertyCategory->update($request->all());
        return new PropertyCategoryResource($propertyCategory);
    }

    public function destroy(Request $request, PropertyCategory $propertyCategory)
    {
        $propertyCategory->delete();
        return response(null, 204);
    }
}
