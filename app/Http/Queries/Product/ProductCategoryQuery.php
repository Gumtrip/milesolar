<?php


namespace App\Http\Queries\Product;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use App\Models\Product\ProductCategory;
use App\Http\Sorts\DefaultSort;
class ProductCategoryQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(ProductCategory::query());
        $this->allowedFilters([
                'title',
            ])
            ->allowedSorts([AllowedSort::custom('default',new DefaultSort(),'id')])
        ->defaultSort('-id');
    }

}
