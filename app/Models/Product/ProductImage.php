<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable=['path','order'];
    protected $appends=['image'];
    function product(){
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute(){
        return asset($this->path);
    }
}
