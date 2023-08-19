<?php

namespace App\Listeners;

use App\Events\VerifyMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

// use Mail;
class VerifyMailFired
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VerifyMail $event): void
    {
        $user = User::find($event->userId)->toArray();
        Mail::send('emailVerifyMail',$user,function($message) use($user){
            $message->to("bishalcodeslaravel@gmail.com");
            $message->subject("test");
        });
    }
}
