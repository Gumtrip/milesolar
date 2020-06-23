<?php

namespace App\Http\Controllers\Api\Frontend\Sample;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Sample\SampleResource;
use App\Http\Queries\Sample\SettingQuery;
use App\Models\Sample\Sample;


class SampleController extends Controller
{
    public function index(Request $request, SettingQuery $sample){
        if($take = $request->take){
            $samples = $sample->take($take)->get();
            return new SampleResource($samples);
        }else{
            $samples = $sample->paginate();
        }
        return SampleResource::collection($samples);
    }

    public function show(Request $request, Sample $sample){
        return new SampleResource($sample);
    }
}
