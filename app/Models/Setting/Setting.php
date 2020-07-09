<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['title','category_id','type','value','order'];

    //配置类型

    const SETTING_TYPE_TEXT = 1;
    const SETTING_TYPE_IMAGE = 2;
    const SETTING_TYPE_FULLTEXT = 3;

    public static $settingTypeMap = [
        self::SETTING_TYPE_TEXT => '文本',
        self::SETTING_TYPE_IMAGE => '图片',
        self::SETTING_TYPE_FULLTEXT => '富文本',
    ];

    /** 根据keys 查询多个配置
     * @param $query
     * @param $keys
     * @return mixed
     */
    public function scopeKeys($query,$keys){
        if(!is_array($keys))$keys = explode(',',$keys);
        return $query->whereIn('keys',$keys);
    }

    public function category(){
        return $this->belongsTo(SettingCategory::class);
    }
}
