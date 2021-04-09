<?php


namespace App\Http\Queries\Client;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Client\Client;

class ClientQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Client::query());
        $this
            ->allowedFilters([
                'name','email','mobile','skype','whatsapp',
            ])
        ->defaultSort('-id');

    }

}
