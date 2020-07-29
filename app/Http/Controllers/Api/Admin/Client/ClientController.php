<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $fillable = ['name','email','mobile','skype','whatsapp'];
}
