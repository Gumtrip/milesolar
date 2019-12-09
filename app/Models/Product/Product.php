<?php

namespace App\Models\Product;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title','category_id','seo_title','seo_keywords','seo_desc','order'];
    protected $appends = ['image_col'];

    //图片集合
    function getImageColAttribute(){
        return $this->images->pluck('name');
    }


    function category(){
        return $this->belongsTo(ProductCategory::class);
    }
    function images(){
        return $this->hasMany(ProductImage::Class);
    }
    function infos(){
        return $this->hasMany(ProductInfo::Class);
    }
}
