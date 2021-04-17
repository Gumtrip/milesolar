<?php


namespace App\Http\Queries\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Product\Property;

class PropertyQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Property::query());

        $this->allowedIncludes(['property_category'])
            ->allowedFilters([
                'title',
                AllowedFilter::scope('property_category_id'),
            ])
            ->defaultSort('-id');
    }

}
