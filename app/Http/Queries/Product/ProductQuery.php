<?php


namespace App\Http\Queries\Product;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Product\Product;

class ProductQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Product::query());

        $this->allowedIncludes(['category','images','infos'] )
            ->allowedFilters([
                'title',
                AllowedFilter::exact('is_index'),
                AllowedFilter::scope('category_id','is_index'),
            ])
            ->allowedAppends(['info_group','path_group','mid_image_group'])
        ->defaultSort('-id');
    }

}
