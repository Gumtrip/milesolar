<?php

namespace App\Http\Controllers\Api\Frontend\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Queries\Article\ArticleQuery;
use App\Models\Article\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, ArticleQuery $article){
        if($take = $request->take){
            $articles = $article->take($take)->get();
            return new ArticleResource($articles);
        }else{
            $articles = $article->paginate(config('app.page_size'));
        }
        return ArticleResource::collection($articles);
    }

    public function show(Request $request, Article $article){
        return new ArticleResource($article);
    }

}
