<?php

namespace App\Models\Product;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Traits\OrderTrait;

class Product extends Model
{
    use Sluggable,OrderTrait;
    protected $fillable = [
        'title',
        'short_title',
        'category_id',
        'brief',
        'offer_desc',
        'is_index',
        'status',
        'seo_title',
        'seo_keywords',
        'seo_desc',
        'order'
    ];


    protected $appends = ['main_image'];

    function getPathGroupAttribute()
    {
        return $this->images->pluck('path');
    }

    function getMainImageAttribute()
    {
        $image = $this->images->sortBy('order')->first();
        if ($image) {
            return asset(getThumbName($image->path, 'mid'));
        } else {
            return null;
        }
    }

    function getSmImgAttribute()
    {
        $image = $this->images->sortBy('order')->first();
        if ($image) {
            return asset(getThumbName($image->path, 'sm'));
        } else {
            return null;
        }
    }

    /** 中图图片集合
     * @return \Illuminate\Support\Collection
     */

    function getMidImageGroupAttribute()
    {
        return collect($this->images)->map(function ($img) {
            return asset(getThumbName($img->path, 'mid'));
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
        return $this->hasMany(ProductImage::class);
    }

    function infos()
    {
        return $this->hasMany(ProductInfo::class);
    }

    function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot(['id']);
    }

    /** 通过category_id 搜索products
     * @param $query
     * @param $categoryId
     * @return mixed
     */
    function scopeCategoryId($query, $categoryId)
    {
        $descendantsAndSelf = ProductCategory::descendantsAndSelf($categoryId);
        return $query->whereIn('category_id', $descendantsAndSelf->pluck('id'));
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
