<?php

namespace App\Models\Sample;

use App\Models\Traits\ImageCollection;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Sample extends Model
{
    use Sluggable;

    use ImageCollection;
    protected $fillable=['title','category_id','is_index','image','intro','desc','seo_title','seo_keywords','seo_desc','order'];
    protected $appends=['mid_img','sm_img','create_date'];

    public function category(){
        return $this->belongsTo(SampleCategory::class);
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
