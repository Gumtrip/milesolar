<?php

namespace App\Http\Controllers\Api\Admin\Page;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;
use App\Http\Resources\Page\PageImageResource;
use App\Models\Page\Page;
use App\Models\Page\PageImage;
use App\Http\Requests\Admin\Page\PageRequest;
use App\Http\Queries\Page\PageQuery;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
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
                foreach ($images as $img) {
                    $image = new PageImage();
                    $image->fill([
                        'path' => $img['path'],
                    ]);
                    $image->page()->associate($page);
                    $image->save();
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
            $existImages = $page->page_images->pluck('path');
            $images = collect($request->images);
            foreach ($images as $img) {
                $path = $img['path'];
                if (!$existImages->contains($path)) {// 没有的插入新值
                    $pageImg = new PageImage();
                    $pageImg->fill([
                        'path' => $path,
                    ]);
                    $pageImg->page()->associate($page);
                    $pageImg->save();
                }
                $existImages->diff($images->pluck('path'))->each(function ($title) use ($page) {// 删掉差值
                    $existImg = PageImage::where('page_id', $page->id)->where('path', $title)->first();
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
