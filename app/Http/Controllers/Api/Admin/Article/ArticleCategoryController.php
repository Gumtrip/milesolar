<?php

namespace App\Http\Controllers\Api\Admin\Article;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleCategoryResource;
use App\Models\Article\ArticleCategory;
use App\Http\Requests\Admin\Article\ArticleCategoryRequest;

class ArticleCategoryController extends Controller
{
    public function index(Request $request,ArticleCategory $articleCategory){
        $categories = $articleCategory->paginate();
        return ArticleCategoryResource::collection($categories);
    }
    public function store(ArticleCategoryRequest $request,ArticleCategory $articleCategory){
        $articleCategory->fill($request->all());
        $articleCategory->save();
        return new ArticleCategoryResource($articleCategory);
    }
    public function show(Request $request,ArticleCategory $articleCategory){
        return new ArticleCategoryResource($articleCategory);
    }
    public function update(ArticleCategoryRequest $request,ArticleCategory $articleCategory){
        $articleCategory->update($request->all());
        return new ArticleCategoryResource($articleCategory);
    }
    public function destroy(Request $request,ArticleCategory $articleCategory){
        $articleCategory->delete();
        return response(null,204);
    }
}
