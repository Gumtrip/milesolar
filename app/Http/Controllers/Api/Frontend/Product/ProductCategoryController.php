<?php

namespace App\Http\Controllers\Api\Frontend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use App\Http\Resources\Product\ProductCategoryResource;
use App\Http\Queries\Product\ProductCategoryQuery;

class ProductCategoryController extends Controller
{
    public function index(Request $request, ProductCategoryQuery $productCategory)
    {
        $categories = $productCategory->get();
        return new ProductCategoryResource($categories);
    }

    public function showTree(Request  $request, ProductCategory $productCategory){
        $depth = $request->depth;
        $categories = $productCategory->withDepth()->when($depth, function ($query) use ($depth) {
            $depth = $depth <= 2 ? $depth : 2;
            return $query->having('depth', '<=', $depth);
        })->get()->toTree();
        return new ProductCategoryResource($categories);
    }


    public function show(Request $request, ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }


}
