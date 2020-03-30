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
        $categories = $productCategory->withDepth()->paginate(config('app.page_size'));
        return  ProductCategoryResource::collection($categories);
    }

    public function showTree(Request $request, ProductCategory $productCategory){
        $depth = $request->depth;
        $id = $request->id;
        $categories = $productCategory->withDepth()->when($depth, function ($query) use ($depth) {
            $depth = $depth <= 2 ? $depth : 2;
            return $query->having('depth', '<=', $depth);
        })->when($id,function($query) use($id){
            //在分类编辑页不能显示自己以及自己的子类
            $descendantsAndSelf = ProductCategory::descendantsAndSelf($id);
            return $query->whereNotIn('id',$descendantsAndSelf->pluck('id'));
        })->get()->toTree();
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
        $data = $request->all();
        if(!$request->order){
            $data['order'] = null;
        }
        if ($parentId && $parentCategory = ProductCategory::find($parentId)) {
            $productCategory->fill($data);
            $productCategory->appendToNode($parentCategory)->save();
        } else {
            $productCategory->makeRoot()->update($data);
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
