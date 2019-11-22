<?php

namespace App\Models\Product;


use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model
{
    use HasMediaTrait;
    protected $fillable=['title','category_id','seo_title','seo_keywords','seo_desc','order'];

    function category(){
        return $this->belongsTo(ProductCategory::class);
    }
}
