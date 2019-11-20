<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=['title','intro','desc','seo_title','seo_keywords','seo_desc','order'];

}
