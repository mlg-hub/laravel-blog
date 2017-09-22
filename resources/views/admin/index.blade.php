@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{URL::to('src/css/modal.css')}}" type="text/css"/>
    @endsection

@section('content')

    <div class="container-div">
        @include('includes.info-box')
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{route('admin.blog.post.create.index')}}" class="btn btn-info">New post</a></li>
                        <li><a href="{{route('all.post')}}" class="btn btn-default">Show all post</a></li>
                    </ul>
                </nav>
            </header>

            <section>
                <ul>
                    @if(count($posts) == 0)

                        <li> No posts available</li>
                        @else

                        @foreach($posts as $post)
                            <li>
                                <article>
                                    <div class="post-info">
                                        <h3>{{$post->title}}</h3>
                                        <span class="info"> Post author: <span class="auth">{{$post->author}}</span> | Date :{{$post->created_at}}</span>
                                    </div>
                                </article>
                                <div class="post-edit">
                                    <nav>
                                        <ul>
                                            <li><a href="{{route('single.post',['post_id' => $post->id, 'end' => 'admin'])}}" class="btn btn-primary">View</a></li>
                                            <li><a href="{{route('view.edit',['post_id' => $post->id])}}" class="btn btn-warning">Edit</a></li>
                                            <li><a href="{{route('post.delete', ['post_id' => $post->id])}}" class="btn btn-danger">Delete</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </li>

                            @endforeach
                        @endif

                    {{--If posts exist--}}

                </ul>
            </section>
        </div>

        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="" class="btn btn-default">Show all Message</a></li>
                    </ul>
                </nav>
            </header>

            <section>
                <ul>
                    {{--If no message--}}
                   @if(count($contact_messages) == 0)  No contact messages @endif
                    {{--If message exist--}}
                    @foreach($contact_messages as $contact_message)
                        <li>
                            <article data-message="{{$contact_message->body}}" data-id="{{$contact_message->id}}">
                                <div class="post-info">
                                    <h3>{{$contact_message->subject}}</h3>
                                    <span class="info"> Sender:<span class="sender">{{$contact_message->sender}}</span> | {{$contact_message->created_at}}</span>
                                </div>
                            </article>
                            <div class="post-edit">
                                <nav>
                                    <ul>
                                        <li><a href="#" class="btn btn-primary">View</a></li>
                                        <li><a href="#" class="btn btn-danger">Delete</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>

    <div class="modal" id="contact-message-info">
        <button class="btn btn-warning" id="modal-close">Close</button>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var token = "{{Session::token()}}";
    </script>
    <script type="text/javascript" src="{{URL::to('src/js/modal.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('src/js/message.js')}}"></script>
@endsection

