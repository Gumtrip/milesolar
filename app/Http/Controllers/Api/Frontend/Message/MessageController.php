<?php

namespace App\Http\Controllers\Api\Frontend\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message\Message;
use App\Http\Requests\Frontend\Message\MessageRequest;
use App\Http\Resources\Message\MessageResource;
class MessageController extends Controller
{
    public function store(MessageRequest $request,Message $message){
        $message->fill($request->all());
        $message->save();
        return new MessageResource($message);
    }
}
