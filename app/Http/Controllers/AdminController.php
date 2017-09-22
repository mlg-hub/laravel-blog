<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use App\Post;

Class AdminController extends Controller{

    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $contact_messages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.index', compact('posts','contact_messages'));
    }

}