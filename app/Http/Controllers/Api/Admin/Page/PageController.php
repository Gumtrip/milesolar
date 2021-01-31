<?php

namespace App\Http\Controllers\Api\Admin\Page;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;
use App\Models\Page\Page;
use App\Models\Image\Image;
use App\Http\Requests\Admin\Page\PageRequest;
use App\Http\Queries\Page\PageQuery;
use App\Models\Product\ProductImage;
use App\Services\ImageHandleService;
use Illuminate\Support\Facades\DB;
use File;

class PageController extends Controller
{
    CONST FOLDER = 'page';

    public function index(Request $request, PageQuery $articleQuery)
    {
        $articles = $articleQuery->paginate(config('app.page_size'));
        return PageResource::collection($articles);
    }

    public function store(PageRequest $request, Page $page)
    {
        DB::transaction(function () use ($request, $page) {
            $page->fill($request->all());
            $page->save();
            if ($images = $request->images) {
                $imageHandleService = app(ImageHandleService::class);//移动图片
                if ($images = $request->images) {
                    foreach ($images as $key => $image) {
                        $img = $image['path'];
                        if (File::exists(public_path($img))) {
                            $path = $imageHandleService->moveFile($img, self::FOLDER, $page->id);
                            $image = new Image(['path' => $path, 'type' => Page::IMG_FOLDER]);
                            $image->page()->associate($page);
                            $image->save();
                        }
                    }
                }
            }
            return $page;
        });

        return new PageResource($page);
    }

    public function show($id, PageQuery $articleQuery)
    {
        $page = $articleQuery->findOrFail($id);
        return new PageResource($page);
    }

    public function update(PageRequest $request, Page $page)
    {
        $page = DB::transaction(function () use ($request, $page) {
            $page->update($request->all());
            $existImages = $page->images->pluck('path');
            $images = collect($request->images);
            foreach ($images as $img) {
                $path = $img['path'];
                if (!$existImages->contains($path)) {// 没有的插入新值
                    $pageImg = new Image();
                    $pageImg->fill([
                        'path' => $path,
                        'type' => Page::IMG_FOLDER
                    ]);
                    $pageImg->page()->associate($page);
                    $pageImg->save();
                }
                $existImages->diff($images->pluck('path'))->each(function ($title) use ($page) {// 删掉差值
                    $existImg = Image::where('page_id', $page->id)->where('path', $title)->first();
                    if ($existImg) {
                        $existImg->delete();
                    }
                });

            }
            return $page;
        });
        return new PageResource($page);
    }

    public function destroy(Request $request, Page $page)
    {
        $page->delete();
        return response(null, 204);
    }
}
