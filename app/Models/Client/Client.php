<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $fillable = ['name', 'no', 'email', 'mobile', 'skype', 'whatsapp'];
    use SoftDeletes;
}
