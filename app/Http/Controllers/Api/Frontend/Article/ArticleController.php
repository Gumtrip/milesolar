<?php

namespace App\Http\Controllers\Api\Frontend\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, Article $article){
        $articles = $article->paginate();
        return ArticleResource::collection($articles);
    }

    public function show(Request $request, Article $article){
        return new ArticleResource($article);
    }

}
