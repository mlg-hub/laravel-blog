<?php

namespace App\Http\Controllers;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller{

    public function getBlogIndex(){

        // fetch some posts
        $posts = Post::orderBy('created_at','desc')->paginate(6);

            foreach ($posts as $post){
                $post->body = $this->shortText($post->body, 24);
                $post->body = $this->shortText($post->body, 24);
            }
        return view('frontend.blog.index', compact('posts'));
    }

    public function getPostIndex(){

        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('admin.blog.index', compact('posts'));
    }

    public function getSinglePost($post_id, $end = 'frontend'){
        // fecth the given post

        $post = Post::find($post_id);

        if(!$post){
            return redirect()->route('blog.index')->with(['fail'=>'post not found']);
        }

        return view($end.'.blog.single',compact('post'));
    }

    public function getCreatePost(){
        $categories = Category::all();
        return view('admin.blog.create_blog', compact('categories'));
    }

    public function createPost(Request $request){

        $this->validate($request, [
           'title' => 'required|max:120|unique:posts',
            'author'=> 'required|max:120',
            'body' =>'required'
        ]);
        $post = new Post();
        $post->title = $request['title'];
        $post->author = $request['author'];
        $post->body = $request['body'];

            $post->save();

        if(strlen($request['categories']) > 0){
            $categoryIds = explode(",", $request['categories']);

            foreach ($categoryIds as $categoryId){
                $post->categories()->attach($categoryId);
            }
        }
        return redirect()->route('admin.index')->with([
            'success' => 'New post saved!'
        ]);
    }
    private function shortText($text, $word_count){

        if(str_word_count($text, 0) > $word_count){

            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0,$pos[$word_count])."...";
        }

        return $text;
    }
    
    public function getViewEdit($post_id){

        $post = Post::find($post_id);
        $categories = Category::all();
        $post_categories = $post->categories;
        $post_categories_ids = array();
        $i = 0;

            foreach ($post_categories as $post_category){
                $post_categories_ids[$i] = $post_category->id;
                $i++;
            }

        if(!$post){
            return redirect()->route('blog.index')->with(['fail'=>'post not found']);
        }

        return view('admin.blog.edit',compact('post','post_categories','categories','post_categories_ids'));

    }

    public function getPostEdit(Request $request){
        $this->validate($request, [
            'title' => 'required|max:120|',
            'author'=> 'required|max:120',
            'body' =>'required'
        ]);

        $post = Post::find($request ['post_id']);
        $post->title = $request['title'];
        $post->author = $request['author'];
        $post->body = $request['body'];
        $post->update();
        $post->categories()->detach();
        if(strlen($request['categories']) > 0){
            $categoryIds = explode(",", $request['categories']);

            foreach ($categoryIds as $categoryId){
                $post->categories()->attach($categoryId);
            }
        }

        return redirect()->route('admin.index')->with(['success' => 'post updated']);

    }

    public function getPostDelete($post_id){

        $post = Post::find($post_id);
        if(!$post){
            return redirect()->route('blog.index')->with(['fail'=>'post not found']);
        }

        $post->delete();
        return redirect()->route('admin.index')->with(['success' => 'Post deleted']);

    }
}