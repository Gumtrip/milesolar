<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title'];

    public function propertyCategory()
    {
        return $this->belongsTo(PropertyCategory::class);
    }
}
