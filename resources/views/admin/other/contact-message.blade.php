@extends('layouts.admin')

@section('title')
    Contact-message
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/modal.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row margin">
            <div class="col-lg-3"></div>
            <section class="list">
                @if(count($contact_messages) == 0)
                    No Contact message
                    @endif
                    @foreach($contact_messages as $contact_message)
                        <article data-message="{{$contact_message->body}}" data-id="{{$contact_message->id}}" class="contact-message">
                            <div class="message-info">
                                <h3>{{$contact_message->subject}}</h3>
                                <h3>Subject</h3>
                                <span class="info">Sender:{{$contact_message->sender}} | {{$contact_message->created_at}}</span>
                            </div>
                            <div class="edit">
                                <nav class="">
                                    <ul>
                                        <li style="display:inline-block;"><a href="#" class="btn btn-warning">View</a></li>
                                        <li style="display:inline-block;"><a href="#" class="btn btn-danger">Delete</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </article>

                    @endforeach
                </section>
            <section>
                @if($contact_messages->lastPage() > 1)
                    <section class="pagination">
                        @if($contact_messages->currentPage() !== 1)
                            <a href="{{$contact_messages->previousPageUrl()}}"><span class="fa fa-caret-left"></span></a>
                        @endif
                        @if($contact_messages->currentPage() !== $contact_messages->lastPage())
                            <a href="{{$contact_messages->nextPageUrl()}}"><span class="fa fa-caret-right"></span></a>
                        @endif
                    </section>
                @endif
            </section>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>

    <div class="modal" id="contact-message-info">
        <button class="btn btn-warning" id="modal-close">Close</button>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript"> var token = "{{Session::token()}}"</script>
    <script type="text/javascript" src ="{{URL::to('src/js/modal.js')}}"></script>
    <script type="text/javascript" src ="{{URL::to('src/js/message.js')}}"></script>
@endsection