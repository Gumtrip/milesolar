<?php

namespace App\Models\Product;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'category_id','brief', 'seo_title', 'seo_keywords', 'seo_desc', 'order'];

    //图片集合
    function getImageGroupAttribute()
    {
        return $this->images->pluck('image');
    }
    function getPathGroupAttribute()
    {
        return $this->images->pluck('path');
    }
    //图片集合
    function getMidImageGroupAttribute()
    {
        return collect($this->image_group)->map(function($img){
            return getThumbName($img,'mid');
        });
    }


    function getInfoGroupAttribute()
    {
        return $this->infos->flatMap(function($info){
            return [$info->title=>$info->content];
        });
    }


    function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    function images()
    {
        return $this->hasMany(ProductImage::Class);
    }

    function infos()
    {
        return $this->hasMany(ProductInfo::Class);
    }
}
