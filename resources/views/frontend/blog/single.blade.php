@extends('layouts.master')

@section('title')
    {{$post->title}}
   @stop

@section('content')
    <div>
        <article>
            <h3>{{$post->title}}</h3>
            <span class="subtitle"> Post Author:{{$post->author}} | date : {{$post->created_at}}</span>

            <p>{{$post->body}}</p>
        </article>
    </div>

    @stop