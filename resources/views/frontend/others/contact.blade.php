@extends('layouts.master')

@section('title')
   Contact
@stop

@section('content')
    @include('includes.info-box')

    <div class="container-fluid">

    <form action="{{route('contact.send.mail')}}" method="post" id="contact-form">
       <div class="form-group">
           <label for="cname">Your name: </label>
               <input type="text" class="form-control" name="cname" id="cname" value="{{Request::old('cname')}}">

       </div>

        <div class="form-group">
            <label for="cmail">Email: </label>
                <input type="text" class="form-control" name="cmail" id="cmail" value="{{Request::old('cmail')}}">

        </div>

        <div class="form-group">
            <label for="csubject"> Subject</label>
                <input type="text" class="form-control" name="csubject" id="csubject" value="{{Request::old('csubject')}}">

        </div>
        <div class="form-group">
            <label for="cmesg">Your message:</label>
                <textarea type="text" class="form-control" name="cmesg" id="cmesg" rows="10">{{Request::old('cmesg')}}</textarea>

        </div>
        <button type="submit" class="btn bt btn-success" > Send message</button>

        <input type="hidden" value="{{Session::token()}}" name="_token">
    </form>

    </div>
@stop