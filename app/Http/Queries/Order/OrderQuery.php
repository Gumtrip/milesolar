<?php


namespace App\Http\Queries\Order;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Order\Order;

class OrderQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Order::query());

        $this
            ->allowedIncludes(['expenses', 'proceeds'])
            ->allowedFilters([
                'no',
                AllowedFilter::exact('client_id'),
            ])
        ->defaultSort('-id');
    }

}
