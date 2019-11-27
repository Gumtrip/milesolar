<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Storage;
class Article extends Model
{
    const THUMB_NAME = 'thumb';
    protected $fillable=['title','category_id','image','intro','desc','seo_title','seo_keywords','seo_desc','order'];

    public function getBigImgAttribute(){
        return asset(Storage::url($this->image));
    }


    public function getThumbAttribute(){
        $fileName = pathinfo($this->image,PATHINFO_FILENAME);
        $ext = pathinfo($this->image,PATHINFO_EXTENSION);
        $newFileName = $fileName.'-'.self::THUMB_NAME.'.'.$ext;
        $dir = pathinfo($this->image,PATHINFO_DIRNAME);
        $fullName = $dir.'/'.$newFileName;
        return asset(Storage::url($fullName));
    }

    public function category(){
        return $this->belongsTo(ArticleCategory::class);
    }

}
