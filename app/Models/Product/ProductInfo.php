<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $fillable=['title','content'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
