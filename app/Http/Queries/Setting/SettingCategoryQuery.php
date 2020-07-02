<?php


namespace App\Http\Queries\Setting;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Setting\SettingCategory;

class SettingCategoryQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(SettingCategory::query());

        $this
            ->allowedFilters([
                'title',
            ])
        ->defaultSort('-id');
    }

}
