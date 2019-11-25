<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Article extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable=['title','category_id','intro','desc','seo_title','seo_keywords','seo_desc','order'];

    const MEDIA_NAME='article';

    public function registerMediaConversions(Media $media = null){
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_STRETCH,config('app.thumb_width'), config('app.thumb_height'))
            ->nonQueued()//用队列创建文件夹总是报permission denied??
            ->sharpen(10)//锐化
        ;

    }

    public function getThumbAttribute(){
        $image = $this->getFirstMedia(self::MEDIA_NAME);
        return $image?$image->getFullUrl('thumb'):'';
    }
    public function getImageAttribute(){
        $image = $this->getFirstMedia(self::MEDIA_NAME);
        return $image?$image->getFullUrl():'';
    }
    public function category(){
        return $this->belongsTo(ArticleCategory::class);
    }

}
