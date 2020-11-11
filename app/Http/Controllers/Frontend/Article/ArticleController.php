<?php


namespace App\Http\Controllers\Frontend\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::paginate(config('app.page_size'));
        $breads = [['title' => 'articles', 'url' => route('articles')]];
        return view(cusView('article.index'))->with(compact('articles', 'breads'));
    }

    public function show(Request $request, Article $article)
    {
        $breads = [
            ['title' => 'articles', 'url' => route('articles')],
            ['title' => $article->title, 'url' => route('articles.show', [$article, $article->slug])]
        ];
        return view(cusView('article.show'))->with(compact('article', 'breads'));

    }
}
