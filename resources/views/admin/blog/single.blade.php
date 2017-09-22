@extends('layouts.admin')

@section('title') {{$post->title}} @endsection

@section('content')
    <div class="container">
        <section>
            <h1>{{$post->title}}</h1>
            <span class="span"> {{$post->title}} | {{$post->created_at}}</span>
            <p>{{$post->body}}</p>
        </section>
    </div>

    @endsection