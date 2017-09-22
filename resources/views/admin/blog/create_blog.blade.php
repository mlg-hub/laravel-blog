@extends ('layouts.admin')
@section('title')
    Create post
    @endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('src/css/form.css')}}"
    @endsection
@section('content')
    <div class="container-div">
        @include('includes.info-box')
        <form action="{{route('admin.blog.post.create')}}" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" id="title" type="text" width="500px" {{$errors->has('title') ? 'class= has-error form-control' : 'class=form-control'}} value="{{Request::old('title')}}"/>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input name="author" id="author" type="text" {{$errors->has('author') ? 'class= has-error' : 'class=form-control'}} value="{{Request::old('author')}}">
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
                    <ul>

                    </ul>
                </div>
                <input type="hidden" name="categories" id="categories"/>
            </div>
            <div class="form-group">
                <label for="Body">Body</label>
                <textarea type="text" id="body" name="body" rows="12" {{$errors->has('author') ? 'class= has-error' : 'class=form-control'}} >{{Request::old('body')}}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">Create Post</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>

    @endsection
@section('scripts')
    <script
            type="text/javascript" src="{{URL::to('src/js/posts.js')}}">
    </script>
    @endsection