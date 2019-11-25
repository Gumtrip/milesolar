<?php

namespace App\Http\Controllers\Api\Admin\Article;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article\Article;
use App\Http\Queries\Article\ArticleQuery;
use App\Http\Requests\Admin\Article\ArticleRequest;
use DB;
class ArticleController extends Controller
{
    public function index(Request $request,ArticleQuery $articleQuery){
        $articles = $articleQuery->paginate();
        return ArticleResource::collection($articles);
    }
    public function store(ArticleRequest $request,Article $article){
        $article->fill($request->all());
        if($request->image){
            $article->addMedia(public_path($request->image))->toMediaCollection('article');
        }
        $article->save();

        return new ArticleResource($article);
    }
    public function show($id,ArticleQuery $articleQuery){
        $article = $articleQuery->findOrFail($id);
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
