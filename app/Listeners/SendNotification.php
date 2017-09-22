<?php

namespace App\Listeners;

use App\Events\messageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNotification
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
        Mail::send('email.contact-message-notification', compact('contact_message'),function($m) use ($contact_message){
            $m->from('info@laravel-udemy.com', 'laravel udemy and morisho');
            $m->to('admin@laravel.com','Laravel udemy course Admin');
            $m->subject('New contact message from:'.$contact_message->email);

        });
    }
}
