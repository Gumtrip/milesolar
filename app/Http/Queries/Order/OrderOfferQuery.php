<?php


namespace App\Http\Queries\Order;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Order\OrderOffer;

class OrderOfferQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(OrderOffer::query());

        $this
            ->allowedIncludes(['items'])
            ->allowedFilters([
                'no',
                AllowedFilter::exact('client_id'),
            ])
            ->defaultSort('-id');
    }

}
