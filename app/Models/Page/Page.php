<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'content', 'seo_title', 'seo_keywords', 'seo_desc'];

    public function images()
    {
        return $this->hasMany(PageImage::class);
    }
}
