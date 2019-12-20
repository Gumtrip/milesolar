<?php

namespace App\Http\Controllers\Api\Frontend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use App\Http\Resources\Product\ProductCategoryResource;

class ProductCategoryController extends Controller
{
    public function index(Request $request, ProductCategory $productCategory)
    {
        $categories = $productCategory->get();
        return new ProductCategoryResource($categories);
    }


    public function show(Request $request, ProductCategory $productCategory)
    {
        return new ProductCategoryResource($productCategory);
    }


}
