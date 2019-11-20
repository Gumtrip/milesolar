<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Http\Resources\Product\ProductResource;
use App\Http\Queries\Product\ProductQuery;
class ProductController extends Controller
{
    public function index(Request $request,ProductQuery $productQuery){
        $products = $productQuery->paginate();
        return ProductResource::collection($products);
    }
    public function store(ProductRequest $request,Product $product){
        $product->fill($request->all());
        $product->save();
        return new ProductResource($product);
    }
    public function show($productId,ProductQuery $productQuery){
        $product = $productQuery->findOrFail($productId);
        return new ProductResource($product);
    }
    public function update(ProductRequest $request,Product $product){
        $product->update($request->all());
        return new ProductResource($product);
    }
    public function destroy(Request $request,Product $product){
        $product->delete();
        return response(null,204);
    }
}
