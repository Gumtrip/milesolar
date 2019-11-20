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
        $depth = $request->depth;
        $categories = $productCategory->withDepth()->when($depth, function ($query) use ($depth) {
            $depth = $depth<=2?$depth:2;
            $query->having('depth', '<=', $depth);
        })->get()->toTree();
        return new ProductCategoryResource($categories);
    }

    public function store(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $parentId = $request->parent_id;
        if ($parentId && $parentCategory = ProductCategory::withDepth()->find($parentId)) {
            if ($parentCategory->depth <= 1) {
                $productCategory = $parentCategory->children()->create($request->all());
            } else {
                return response('最多支持3级分类', 412);
            }
        } else {
            $productCategory->fill($request->all());
            $productCategory->makeRoot()->save();
        }
        $productCategory::fixTree();
        return new ProductCategoryResource($productCategory);

    }

    public function show(Request $request, ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $parentId = $request->parent_id;
        if ($parentId && $parentCategory = ProductCategory::withDepth()->find($parentId)) {
            //这里需要保证父级dept=1,自身没有任何子节点
            //这里需要保证父级dept=0,自身允许有一级子节点
            if ($parentCategory->depth == 0||
                ($parentCategory->depth == 1&&$productCategory->descendants->count()==0)) {
                $productCategory->fill($request->all());
                $productCategory->appendToNode($parentCategory)->save();
            } else {
                return response('最多支持3级分类', 412);
            }
        } else {
            $productCategory->makeRoot()->update($request->all());
        }
        return new ProductCategoryResource($productCategory);
    }

    public function destroy(Request $request, ProductCategory $productCategory)
    {
        $productCategory->delete();
        return response(null, 204);
    }
}
