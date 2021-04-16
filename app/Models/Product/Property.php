<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title'];

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class);
    }
}
