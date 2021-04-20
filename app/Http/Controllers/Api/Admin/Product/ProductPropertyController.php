<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductProperty;
use App\Http\Requests\Admin\Product\ProductPropertyRequest;
use App\Http\Resources\Product\ProductPropertyResource;

class ProductPropertyController extends Controller
{

    public function store(ProductPropertyRequest $request, ProductProperty $productProperty)
    {
        $productProperty->product()->associate($request->product_id);
        $productProperty->property()->associate($request->property_id);
        $productProperty->save();
        return new ProductPropertyResource($productProperty);
    }


    public function destroy(Request $request, ProductProperty $productProperty)
    {
        $productProperty->delete();
        return response(null, 204);
    }
}
