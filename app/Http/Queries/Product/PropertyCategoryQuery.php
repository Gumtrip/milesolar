<?php


namespace App\Http\Queries\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Product\PropertyCategory;

class PropertyCategoryQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(PropertyCategory::query());
        $this->allowedIncludes(['product'])
            ->defaultSort('-id');
    }

}
