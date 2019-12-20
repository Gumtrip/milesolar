<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ProductCategory extends Model
{
    use NodeTrait;
    protected $fillable=['title','image','seo_title','seo_keywords','seo_desc','order'];
    protected $appends=['mid_img'];
    public function getBigImgAttribute(){
        return asset($this->image);
    }

    public function getMidImgAttribute(){
        return asset(getThumbName($this->image,'mid'));
    }



}
