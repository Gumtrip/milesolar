<?php

namespace App\Http\Controllers\Api\Admin\Message;

use App\Http\Requests\Admin\BackendRequest as Request;
use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use App\Http\Resources\Message\MessageResource;
class MessageController extends Controller
{
    public function index(Request $request,Message $message){
        $messages = $message->orderBy('id','desc')->paginate(config('app.page_size'));
        return MessageResource::collection($messages);
    }

    public function show(Request $request,Message $message){
        return new MessageResource($message);
    }

    public function destroy(Request $request,Message $message){
        $message->delete();
        return response(null,204);
    }
}
