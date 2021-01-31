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

    public function images()
    {
        return $this->hasMany(Image::class, 'foreign_id')->where('type', self::IMG_FOLDER);
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


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
