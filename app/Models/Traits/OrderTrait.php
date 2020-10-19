<?php


namespace App\Models\Traits;


trait OrderTrait
{
    public function scopeCusOrder($query,$property,$direction='ASC')
    {
        return $query->orderByRaw("IF(ISNULL(`order`),1,0),`order` ASC,(`{$property}`) {$direction}");
    }
}
