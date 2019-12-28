<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['product_id','product_info','email','phone','skype','name','msg'];

    protected $casts = [
        'product_info'=>'array'
    ];
}
