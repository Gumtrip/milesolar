<?php

namespace App\Models\Article;

use App\Models\Traits\ImageCollection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Storage;
use Carbon\Carbon;
class Article extends Model
{
    use ImageCollection;
    protected $fillable=['title','category_id','image','intro','desc','seo_title','seo_keywords','seo_desc','order'];
    protected $appends=['mid_img','sm_img','create_date'];

    public function category(){
        return $this->belongsTo(ArticleCategory::class);
    }

    public function getCreateDateAttribute(){
        return $this->created_at->toDateString();
    }
}
