<?php

namespace App\Http\Controllers\Api\Admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Queries\Article\ArticleQuery;
use App\Models\Article\Article;
use App\Http\Requests\Admin\Article\ArticleRequest;
class ArticleController extends Controller
{
    public function index(Request $request,ArticleQuery $productQuery){
        $products = $productQuery->paginate();
        return ArticleResource::collection($products);
    }
    public function store(ArticleRequest $request,Article $article){
        $article->fill($request->all());
        $article->save();
        return new ArticleResource($article);
    }
    public function show($productId,ArticleQuery $productQuery){
        $article = $productQuery->findOrFail($productId);
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
