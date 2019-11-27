<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Storage;
class Article extends Model
{
    protected $fillable=['title','category_id','image','intro','desc','seo_title','seo_keywords','seo_desc','order'];

    public function getBigImgAttribute(){
        return asset(Storage::url($this->image));
    }


    public function getThumbAttribute(){
        $fullName = getThumbName($this->image);
        return asset(Storage::url($fullName));
    }

    public function category(){
        return $this->belongsTo(ArticleCategory::class);
    }

}
