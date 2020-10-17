<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['product_id','ip','product_info','email','phone','skype','name','msg','country'];

    protected $casts = [
        'product_info'=>'array'
    ];
}
