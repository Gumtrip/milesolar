<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;
use App\Models\Page\Page;

class Image extends Model
{
    protected $fillable = ['path', 'title', 'type'];

    public function page()
    {
        return $this->belongsTo(Page::class, 'foreign_id')->where('type', Page::IMG_FOLDER);
    }
}
