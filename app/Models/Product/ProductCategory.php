<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Traits\ImageCollection;
class ProductCategory extends Model
{
    use NodeTrait,ImageCollection;
    protected $fillable=['title','brief','image','seo_title','seo_keywords','seo_desc','order'];
    protected $appends=['mid_img','sm_img'];

    /**
     * @return string
     */
    public function getBriefListAttribute(){
        return explode("\n",trim($this->brief));
    }
}
