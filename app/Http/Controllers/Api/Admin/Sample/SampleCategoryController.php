<?php

namespace App\Http\Controllers\Api\Admin\Sample;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Sample\SampleCategoryResource;
use App\Models\Sample\SampleCategory;
use App\Http\Requests\Admin\Sample\SampleCategoryRequest;
class SampleCategoryController extends Controller
{
    public function index(Request $request,SampleCategory $sampleCategory){
        $categories = $sampleCategory->paginate(config('app.page_size'));
        return SampleCategoryResource::collection($categories);
    }
    public function store(SampleCategoryRequest $request,SampleCategory $sampleCategory){
        $sampleCategory->fill($request->all());
        $sampleCategory->save();
        return new SampleCategoryResource($sampleCategory);
    }
    public function show(Request $request,SampleCategory $sampleCategory){
        return new SampleCategoryResource($sampleCategory);
    }
    public function update(SampleCategoryRequest $request,SampleCategory $sampleCategory){
        $sampleCategory->update($request->all());
        return new SampleCategoryResource($sampleCategory);
    }
    public function destroy(Request $request,SampleCategory $sampleCategory){
        $sampleCategory->delete();
        return response(null,204);
    }
}
