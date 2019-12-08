<?php

namespace App\Models\Product;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title','category_id','desc_0','desc_1','desc_2','seo_title','seo_keywords','seo_desc','order'];

    function category(){
        return $this->belongsTo(ProductCategory::class);
    }
    function images(){
        return $this->hasMany(ProductImage::Class);
    }
}
