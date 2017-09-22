<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //

    Route::get('/', [
       'uses' => 'PostController@getBlogIndex',
        'as' => 'blog.index'
    ]);

    Route::get('/blog/', [
        'uses' => 'PostController@getBlogIndex',
        'as' => 'blog.index'
    ]);
//    Route::get('/blog/{post_id}&{end}', [
//        'uses' => 'PostController@getSingle',
//        'as' => 'blog.single'
//    ]);
    Route::get('/about',function(){
        return view('frontend.others.about');
    })->name('about');
    Route::get('/contact',[
        'uses' => 'ContactController@getContactIndex',
        'as'    => 'contact'
    ]);
    //Send mails routes

    Route::post('/contact/sendmail',[
        'uses' => 'ContactController@sendMessage',
        'as' => 'contact.send.mail'
    ]);

Route::group(['prefix' => '/admin'], function(){

    Route::get('/',[
       'uses' =>'AdminController@getIndex',
        'as'  => 'admin.index'
    ]);

    Route::get('/blog/post', [
        'uses' => 'PostController@getPostIndex',
        'as' =>'all.post'
    ]);

    //single post view

    Route::get('/blog/post/{post_id}&{end}', [

        'uses' =>'PostController@getSinglePost',
        'as' => 'single.post'
    ]);
    Route::get('/blog/posts/create', [
       'uses' =>'PostController@getCreatePost',
        'as'    =>'admin.blog.post.create.index'
    ]);
    Route::post('/blog/posts/create', [
        'uses' =>'PostController@createPost',
        'as' =>'admin.blog.post.create'
    ]);
    Route::get('/blog/post/{post_id}/edit', [
        'uses'=>'PostController@getViewEdit',
        'as' =>'view.edit'
    ]);
    Route::post('/blog/post/edit',[
        'uses'=>'PostController@getPostEdit',
        'as' =>'post.update'
    ]);
    Route::get('/blog/post/{post_id}/delete', [
            'uses'=>'PostController@getPostDelete',
            'as' =>'post.delete'
    ]);

            //ADMIN CATEGORIES ROUTES
    Route::get('/blog/category',[
        'uses' => 'CategoryController@getCategoryIndex',
        'as'    =>'all.categories'
    ]);

    Route::post('/blog/category/create',[
        'uses' => 'CategoryController@CreateCategory',
        'as' =>'create.category'
    ]);

    Route::post('/blog/categories/update', [
       'uses' => 'CategoryController@updateCategory',
        'as'  => 'update.category'
    ]);

    Route::get('blog/category/{category_id}/delete',[
        'uses' => 'CategoryController@deleteCategory',
        'as' => 'delete.category'
    ]);

        //ADMIN contact messages routes
    Route::get('/contact/message',[
        'uses'=>'ContactController@getContactMessage',
        'as'=>'get.contact.message'
    ]);

});
});
