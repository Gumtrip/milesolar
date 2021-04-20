<?php

namespace App\Http\Controllers\Api\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\PropertyRequest;
use App\Http\Resources\Product\PropertyResource;
use App\Models\Product\Property;
use App\Http\Queries\Product\PropertyQuery;

class PropertyController extends Controller
{

    public function index(Request $request, PropertyQuery $propertyQuery)
    {
        $properties = $propertyQuery->paginate(config('app.page_size'));
        return PropertyResource::collection($properties);
    }

    public function store(PropertyRequest $request, Property $property)
    {
        $property->fill($request->all());
        $property->propertyCategory()->associate($request->property_category_id);
        $property->save();
        return new PropertyResource($property);
    }

    public function show($id, PropertyQuery $propertyQuery)
    {
        $property = $propertyQuery->findOrFail($id);
        return new PropertyResource($property);
    }

    public function update(PropertyRequest $request, Property $property)
    {
        $property->propertyCategory()->associate($request->property_category_id);
        $property->update($request->all());
        return new PropertyResource($property);
    }

    public function destroy(Request $request, Property $property)
    {
        $property->delete();
        return response(null, 204);
    }
}
