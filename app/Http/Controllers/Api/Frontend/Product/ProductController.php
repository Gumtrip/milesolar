<?php

namespace App\Http\Controllers\Api\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Http\Queries\Product\ProductQuery;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductQuery $productQuery){
        $products = $productQuery->paginate();
        return ProductResource::collection($products);
    }
    public function show($productId,ProductQuery $productQuery){
        $product = $productQuery->findOrFail($productId);
        return new ProductResource($product);
    }

}
