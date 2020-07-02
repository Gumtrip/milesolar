<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['title','category_id','key','type','value','order'];


    /** 根据keys 查询多个配置
     * @param $query
     * @param $keys
     * @return mixed
     */
    public function scopeKeys($query,$keys){
        if(!is_array($keys))$keys = explode(',',$keys);
        return $query->whereIn('keys',$keys);
    }
}
