<?php

namespace App\Http\Controllers\Api\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Http\Queries\Product\ProductQuery;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductQuery $productQuery){

        if($take = $request->take){
            $products = $productQuery->with('images')->take($take)->get();
        }else{
            $products = $productQuery->with('images')->paginate(config('app.page_size'));
        }
        return ProductResource::collection($products);
    }
    public function show($productId,ProductQuery $productQuery){
        $product = $productQuery->findOrFail($productId);
        return new ProductResource($product);
    }

}
