<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    protected $fillable = ['path'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
