<?php

namespace App\Http\Controllers\Api\Admin\Page;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;
use App\Http\Resources\Page\PageImageResource;
use App\Models\Page\Page;
use App\Http\Requests\Admin\Page\PageRequest;
use App\Http\Queries\Page\PageQuery;

class PageController extends Controller
{
    public function index(Request $request, PageQuery $articleQuery)
    {
        $articles = $articleQuery->paginate(config('app.page_size'));
        return PageResource::collection($articles);
    }

    public function store(PageRequest $request, Page $page)
    {
        $page->fill($request->all());
        $page->save();
        return response(null, 201);
    }

    public function show($id, PageQuery $articleQuery)
    {
        $page = $articleQuery->findOrFail($id);
        return new PageResource($page);
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        return new PageResource($page);
    }

    public function destroy(Request $request, Page $page)
    {
        $page->delete();
        return response(null, 204);
    }
}
