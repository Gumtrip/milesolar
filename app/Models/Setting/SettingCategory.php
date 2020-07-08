<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class SettingCategory extends Model
{
    protected $fillable = ['title','order'];
}
