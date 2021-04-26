<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    protected $fillable = ['title'];


    public function scopeIdIn($query, ...$ids)
    {
        return $query->whereIn('id', $ids);
    }
}
