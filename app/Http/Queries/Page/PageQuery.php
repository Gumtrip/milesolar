<?php


namespace App\Http\Queries\Page;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Page\Page;

class PageQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Page::query());

        $this
            ->allowedIncludes(['images'])
            ->allowedFilters([
                'title'
            ])
            ->defaultSort('-id');
    }

}
