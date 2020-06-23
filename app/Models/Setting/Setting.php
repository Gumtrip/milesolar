<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['title','key','value'];

    public function scopeKeys($query,$keys){
        if(!is_array($keys))$keys = explode(',',$keys);
        return $query->whereIn('keys',$keys);
    }
}
