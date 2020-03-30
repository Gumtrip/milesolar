<?php


namespace App\Http\Sorts;
use \Spatie\QueryBuilder\Sorts\Sort;
use Illuminate\Database\Eloquent\Builder;
class DefaultSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'ASC' : 'DESC';
        $query->orderByRaw("IF(ISNULL(`order`),1,0),`order` ASC,(`{$property}`) {$direction}");
    }
}
