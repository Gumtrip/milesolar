<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\SettingCategory;
use App\Http\Resources\Setting\SettingCategoryResource;
use App\Http\Requests\Admin\Setting\SettingCategoryRequest;
use App\Http\Queries\Setting\SettingCategoryQuery;
class SettingCategoryController extends Controller
{
    public function index(Request $request, SettingCategory $settingCategory)
    {
        $settings = $settingCategory->paginate(config('app.page_size'));
        return SettingCategoryResource::collection($settings);
    }

    public function store(SettingCategoryRequest $request, SettingCategory $settingCategory)
    {
        $settingCategory->fill($request->all());
        $settingCategory->save();
        return response(null,201);
    }
    public function show($id, SettingCategoryQuery $settingCategoryQuery)
    {
        $settingCategory = $settingCategoryQuery->findOrFail($id);
        return new SettingCategoryResource($settingCategory);
    }

    public function update(SettingCategoryRequest $request, SettingCategory $settingCategory)
    {
        $settingCategory->update($request->all());
        return new SettingCategoryResource($settingCategory);
    }

    public function destroy(Request $request, SettingCategory $settingCategory)
    {
        $settingCategory->delete();
        return response(null, 204);
    }
}
