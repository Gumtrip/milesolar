<?php

namespace App\Http\Controllers\Api\Frontend\Setting;

use App\Http\Queries\Setting\SettingQuery;
use App\Http\Resources\Setting\SettingResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Setting\SettingRequest;
class SettingController extends Controller
{
    public function index(SettingRequest $request, SettingQuery $settingQuery)
    {
        $settings = $settingQuery->get();
        return SettingResource::collection($settings);
    }
    public function show($id, SettingQuery $settingQuery)
    {
        $setting = $settingQuery->findOrFail($id);
        return new SettingResource($setting);
    }

}
