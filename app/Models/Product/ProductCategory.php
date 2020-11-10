<?php

namespace App\Models\Product;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Traits\ImageCollection;

class ProductCategory extends Model
{
    use NodeTrait,ImageCollection,OrderTrait;

    protected $fillable=['title','brief','image','seo_title','seo_keywords','seo_desc','order','slug'];
    protected $appends=['mid_img','sm_img'];

    /**
     * @return string
     */
    public function getBriefListAttribute(){
        return explode("\n",trim($this->brief));
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
