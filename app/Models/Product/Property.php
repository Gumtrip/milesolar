<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title', 'property_category_id'];

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class);
    }
}
