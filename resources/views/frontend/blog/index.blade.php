@extends ('layouts.master')

@section('title')
    Welcome
    @stop

@section('content')

    @foreach($posts as $post)
        <div>
            <article class="blog-post">
                <h3>{{$post->title}}</h3>
                <span class="subtitle"> Post Author: {{$post->author}} | Date: {{$post->created_at}}</span>

                <p>{{$post->body}}</p>
                <a href="{{route('single.post',['post_id' => $post->id, 'end' => 'frontend'])}}">Read more</a>
            </article>
        </div>
        @endforeach

    @if($posts->lastPage() > 1)
        <section class="pagination">
            @if($posts->currentPage() !== 1)
                <a href="{{$posts->previousPageUrl()}}"><i class="fa fa-caret-left"></i></a>
                @endif
            @if($posts->currentPage() !== $posts->lastPage())
                    <a href="{{$posts->nextPageUrl()}}"><i class="fa fa-caret-right"></i></a>
                @endif
        </section>
    @endif
@stop