<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use App\Http\Resources\Setting\SettingResource;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Queries\Setting\SettingQuery;
class SettingController extends Controller
{
    public function index(Request $request, SettingQuery $settingQuery)
    {
        $settings = $settingQuery->paginate(config('app.page_size'));
        return SettingResource::collection($settings);
    }

    public function store(SettingRequest $request, Setting $setting)
    {
        $setting->fill($request->all());
        $setting->save();
        return response(null,201);
    }

    public function show($id, SettingQuery $settingQuery)
    {
        $setting = $settingQuery->findOrFail($id);
        return new SettingResource($setting);
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->all());
        return new SettingResource($setting);
    }

    public function destroy(Request $request, Setting $setting)
    {
        $setting->delete();
        return response(null, 204);
    }


}
