@extends ('layouts.admin')
@section('title')
    Edit
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/form.css')}}"
@endsection
@section('content')
    <div class="container-div">
        @include('includes.info-box')
        <form action="{{route('post.update')}}" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" id="title" type="text" width="500px" {{$errors->has('title') ? 'class= has-error' : 'class=form-control'}} value="{{Request::old('title')? Request::old('title') : isset($post)? $post->title : ''}}"/>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input name="author" id="author" type="text" {{$errors->has('author') ? 'class= has-error' : 'class=form-control'}} value="{{Request::old('author')? Request::old('author') : isset($post)? $post->author : ''}}">
            </div>

            <div class="form-group">
                <label for="category_select">Add categories</label>
                <select name="category" id="category_select" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}}</option>
                        
                        @endforeach
                </select>
                <button type="button" id="btn" class="btn btn-primary">Add category</button><div class="clearfix"></div>
                <div class="added-categories">
                    <ul >
                        @foreach($post_categories as $post_category)
                            <li class="added"><a href="#" data-id="{{$post_category->id}}">{{$post_category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" name="categories" id="categories" value="{{implode(",", $post_categories_ids)}}"/>
            </div>
            <div class="form-group">
                <label for="Body">Body</label>
                <textarea type="text" id="body" name="body" rows="12" {{$errors->has('body') ? 'class= has-error' : 'class=form-control'}} >{{Request::old('body')? Request::old('body') : isset($post)? $post->body : ''}}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">Save Post</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <input type="hidden" name="post_id" value="{{$post->id}}">
        </form>
    </div>

@endsection
@section('scripts')
    <script
       type="text/javascript" src="{{URL::to('src/js/posts.js')}}">
    </script>

@endsection