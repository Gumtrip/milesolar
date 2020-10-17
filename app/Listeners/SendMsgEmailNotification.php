<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Message\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\MsgNotification;
use App\Events\ReceiveMsg;
class SendMsgEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if(app()->environment('production')){
//            Mail::to('milly@milesolar.com')->queue(new MsgNotification($event->message));
        }
    }
}
