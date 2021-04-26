<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductProperty;
use App\Models\Product\Product;
use App\Http\Requests\Admin\Product\ProductPropertyRequest;
use App\Http\Resources\Product\ProductPropertyResource;

class ProductPropertyController extends Controller
{

    public function store(ProductPropertyRequest $request, ProductProperty $productProperty)
    {
        $properties = $request->properties;
        $productId = $request->product_id;
        $product = Product::find($productId);
        $existIds = $product->properties->pluck('id')->toArray();
        foreach ($properties as $property) {
            $propertyId = $property['id'];
            if (!in_array($propertyId, $existIds)) {
                $productProperty->product()->associate($productId);
                $productProperty->property()->associate($property['id']);
                $productProperty->save();
            }

        }
        return response(null, 201);
    }


    public function destroy(Request $request, ProductProperty $productProperty)
    {
        $productProperty->delete();
        return response(null, 204);
    }
}
