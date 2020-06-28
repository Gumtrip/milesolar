<?php


namespace App\Http\Queries\Sample;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Sample\Sample;

class SampleQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Sample::query());

        $this
            ->allowedIncludes(['category'])
            ->allowedFilters([
                'title',
                AllowedFilter::exact('is_index'),
            ])
        ->defaultSort('-id');
    }

}
