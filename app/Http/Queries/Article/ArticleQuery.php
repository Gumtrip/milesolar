<?php


namespace App\Http\Queries\Article;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Article\Article;

class ArticleQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Article::query());

        $this
            ->allowedIncludes(['category'])
            ->allowedFilters([
                AllowedFilter::exact('is_index'),
                'title',
                'is_index'
            ])
        ->defaultSort('-id');
    }

}
