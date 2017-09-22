@extends('layouts.admin')

@section('title') Categories @endsection

@section('styles')
    <link href="{{URL::to('src/css/categories.css')}}" rel="stylesheet">
    @endsection

@section('content')
    <div class="container">
        <div class="row margin">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 category-admin" id="category-admin">
                <form class="form-group" action="#" method="get">
                    <div>
                      <label for="addcat"> Create category</label>
                        <input type="text" name="name" id="name">
                        <button type="submit" class="btn btn-primary">Create category</button>
                    </div>
                </form>

                <section class="list">
                    @foreach($categories as $category)
                        <article>
                            <div class="category-info" data-id="{{$category->id}}">
                                <h3>{{$category->name}}</h3>
                            </div>
                            <div class="edit">
                                <nav class="">
                                    <ul>
                                        <li class="category-edit"><input type="text"/> </li>
                                        <li><a href="#" class="btn btn-warning">Edit</a></li>
                                        <li><a href="#" class="btn btn-danger">Delete</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </article>

                        @endforeach
                </section>

                <section>
                    @if($categories->lastPage() > 1)
                        <section class="pagination">
                            @if($categories->currentPage() !== 1)
                                <a href="{{$categories->previousPageUrl()}}"><span class="fa fa-caret-left"></span></a>
                            @endif
                            @if($categories->currentPage() !== $categories->lastPage())
                                <a href="{{$categories->nextPageUrl()}}"><span class="fa fa-caret-right"></span></a>
                            @endif
                        </section>
                    @endif
                </section>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        var token = "{{Session::token()}}";
    </script>
        <script type="text/javascript" src="{{Url::to('src/js/categories.js')}}"></script>

    @endsection