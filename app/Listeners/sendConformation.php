<?php

namespace App\Listeners;

use App\Events\messageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class sendConformation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  messageSent  $event
     * @return void
     */
    public function handle(messageSent $event)
    {
        $contact_message = $event->message;
        Mail::send('email.contact-message-confirmation', compact('contact_message'),function($m) use ($contact_message){
            $m->from('info@laravel-udemy.com', 'laravel udemy and morisho');
            $m->to($contact_message->email, $contact_message->sender);
            $m->subject('We recieved your email');

       });
    }
}
