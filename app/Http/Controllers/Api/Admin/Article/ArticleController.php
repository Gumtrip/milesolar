<?php

namespace App\Http\Controllers\Api\Admin\Article;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article\Article;
use App\Http\Requests\Admin\Article\ArticleRequest;
class ArticleController extends Controller
{
    public function index(Request $request,Article $article){
        $articles = $article->paginate();
        return ArticleResource::collection($articles);
    }
    public function store(ArticleRequest $request,Article $article){
        $article->fill($request->all());
        $article->save();
        return new ArticleResource($article);
    }
    public function show(Request $request,Article $article){
        return new ArticleResource($article);
    }
    public function update(ArticleRequest $request,Article $article){
        $article->update($request->all());
        return new ArticleResource($article);
    }
    public function destroy(Request $request,Article $article){
        $article->delete();
        return response(null,204);
    }
}