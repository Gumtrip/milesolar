<?php


namespace App\Http\Queries\Setting;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Setting\Setting;

class SettingQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Setting::query());

        $this
            ->allowedIncludes(['category'])
            ->allowedFilters([
                'title',
                AllowedFilter::exact('category_id'),
                AllowedFilter::scope('titles'),
            ])
        ->defaultSort('-id');
    }

}
