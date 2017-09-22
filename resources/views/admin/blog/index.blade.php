@extends('layouts.admin')

@section('title')
    All posts
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/form.css')}}">
@endsection
@section('content')
    <div class="container-div">
        <div class="row">
        <a href="{{route('admin.blog.post.create.index')}}"><button class=" col-lg-2 btn btn-warning">New post</button></a>
        </div>
    <div class="row">
    <div class="col-lg-8">
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
                                    <li><a href="{{route('single.post',['post_id' => $post->id, 'end' => 'admin'])}}" class="btn btn-warning">View</a></li>
                                    <li><a href="{{route('view.edit',['post_id' => $post->id])}}" class="btn btn-warning">Edit</a></li>
                                    <li><a href="{{route('post.delete',['post_id' => $post->id])}}" class="btn btn-danger">Delete</a></li>
                                </ul>
                            </nav>
                        </div>
                    </li>

                @endforeach
            @endif

            {{--If posts exist--}}

        </ul>
    </div>
</div>

       <section>
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
       </section>
</div>
@endsection