<?php

namespace App\Models\Article;

use App\Models\Traits\ImageCollection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Storage;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use Sluggable;

    use ImageCollection;
    protected $fillable=['title','category_id','image','intro','desc','is_index','seo_title','seo_keywords','seo_desc','order'];

    protected $appends=['mid_img','sm_img','create_date'];

    public function category(){
        return $this->belongsTo(ArticleCategory::class);
    }

    public function getCreateDateAttribute(){
        return $this->created_at->toDateString();
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
