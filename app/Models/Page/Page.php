<?php

namespace App\Models\Page;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image\Image;

class Page extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'image', 'brief', 'content', 'seo_title', 'seo_keywords', 'seo_desc'];

    CONST IMG_FOLDER = 'page';

    /**图片，下一个版本将会废弃这个方法
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'foreign_id')->where('type', self::IMG_FOLDER);
    }
    /**
     * 备用，读取图片的下一个版本
     */
//    public function images()
//    {
//        return $this->morphMany('App\Models\Image\Image', 'imageable');
//    }


    /** 中图图片集合
     * @return \Illuminate\Support\Collection
     */

    function getMidImageGroupAttribute()
    {
        return collect($this->images)->map(function ($img) {
            return asset(getThumbName($img->path, 'mid'));
        });
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
