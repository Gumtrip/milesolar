<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Requests\Admin\Product\ProductCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use App\Http\Resources\Product\ProductCategoryResource;

class ProductCategoryController extends Controller
{
    public function index(Request $request, ProductCategory $productCategory)
    {
//        $depth = $request->depth;
//        $categories = $productCategory->withDepth()->when($depth, function ($query) use ($depth) {
//            $depth = $depth <= 2 ? $depth : 2;
//            $query->having('depth', '<=', $depth);
//        })->get()->toTree();
        $categories = $productCategory->withDepth()->paginate();
        return new ProductCategoryResource($categories);
    }

    public function store(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $parentId = $request->parent_id;
        if ($parentId && $parentCategory = ProductCategory::find($parentId)) {
            $productCategory = $parentCategory->children()->create($request->all());
        } else {
            $productCategory->fill($request->all());
            $productCategory->makeRoot()->save();
        }
        return new ProductCategoryResource($productCategory);

    }

    public function show(Request $request, ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $parentId = $request->parent_id;
        if ($parentId && $parentCategory = ProductCategory::find($parentId)) {
            $productCategory->fill($request->all());
            $productCategory->appendToNode($parentCategory)->save();
        } else {
            $productCategory->makeRoot()->update($request->all());
        }
        $productCategory::fixTree();
        return new ProductCategoryResource($productCategory);
    }

    public function destroy(Request $request, ProductCategory $productCategory)
    {
        $productCategory->delete();
        return response(null, 204);
    }
}
