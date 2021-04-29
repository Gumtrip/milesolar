<?php


namespace App\Models\Traits;


trait OrderTrait
{
    /**默认排序
     * @param $query
     * @param $property
     * @param string $direction
     * @return mixed
     */
    public function scopeCusOrder($query, $property, $direction = 'ASC')
    {
        return $query->orderByRaw("IF(ISNULL(`order`),1,0),`order` ASC,(`{$property}`) {$direction}");
    }
}
