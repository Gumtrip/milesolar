<?php

namespace App\Models\Product;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'category_id','brief', 'seo_title', 'seo_keywords', 'seo_desc', 'order'];


    protected $appends = ['main_img'];

    function getPathGroupAttribute()
    {
        return $this->images->pluck('path');
    }

    function getMainImgAttribute()
    {
        $image = $this->images->sortBy('order')->first();
        if($image){
            return asset(getThumbName($image->path,'mid'));
        }else{
            return null;
        }
    }

    /** 中图图片集合
     * @return \Illuminate\Support\Collection
     */

    function getMidImageGroupAttribute()
    {
        return collect($this->image_group)->map(function($img){
            return getThumbName($img,'mid');
        });
    }


    /** 详情集合
     * @return mixed
     */

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
