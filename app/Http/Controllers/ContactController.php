<?php

namespace App\Http\Controllers;

use App\Events\messageSent;
use Illuminate\Http\Request;
use App\ContactMessage;
use Illuminate\Support\Facades\Event;

Class ContactController extends Controller{

    public function getContactIndex(){
        return view('frontend.others.contact');
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
           'cname' => 'required|max:100',
            'cmesg' =>   'required',
            'csubject' => 'required',
            'cmail' => 'required| min:10'
        ]);
        $message = new ContactMessage();
        $message->email = $request['cmail'];
        $message->sender = $request['cname'];
        $message->body = $request['cmesg'];
        $message->subject = $request['csubject'];
        $message->save();
        Event::fire(new messageSent($message));
        return redirect()->route('contact')->with(['success'=> 'Message successfully sent!']);
    }

    public function getContactMessage(){
        $contact_messages = ContactMessage::orderBy('created_at','desc')->paginate(5);
        return view('admin.other.contact-message', compact('contact_messages'));
    }

}