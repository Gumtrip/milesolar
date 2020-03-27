<?php

namespace App\Http\Controllers\Api\Admin\Sample;

use App\Http\Queries\Sample\SampleQuery;
use App\Http\Requests\Admin\Sample\SampleRequest;
use App\Http\Resources\Sample\SampleResource;
use App\Models\Sample\Sample;
use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;

class SampleController extends Controller
{
    public function index(Request $request, SampleQuery $sampleQuery)
    {
        $samples = $sampleQuery->paginate(config('app.page_size'));
        return SampleResource::collection($samples);
    }

    public function store(SampleRequest $request, Sample $sample)
    {
        $sample->fill($request->all());
        $sample->save();
        return response(null,201);
    }

    public function show($id, SampleQuery $sampleQuery)
    {
        $article = $sampleQuery->findOrFail($id);
        return new SampleResource($article);
    }

    public function update(Request $request, Sample $sample)
    {
        $sample->update($request->all());
        return new SampleResource($sample);
    }

    public function destroy(Request $request, Sample $sample)
    {
        $sample->delete();
        return response(null, 204);
    }
}
