<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

Class CategoryController extends Controller{

    public function getCategoryIndex(){

        $categories = Category::orderBy('created_at','desc')->paginate(2);

            return view('admin.blog.categories', compact('categories'));
    }

    public function CreateCategory(Request $request){
        $this->validate($request, [
           'name' => 'unique:categories|required'
        ]);

        $category = new Category();
        $category->name = $request['name'];

        if($category->save()){
            return Response::json(['message'=> 'category created.'], 200);
        }

        return Response::json(['message' => 'Error occured when trying to save'], 404);
    }

    public function updateCategory(Request $request){
        $this->validate($request,[
            'name' =>'required|unique:categories'
        ]);

        $category = Category::find($request['category_id']);
        if(!$category){
            return Response::json(['message' => 'Category not found'],404);
        }

        $category->name = $request['name'];
        $category->update();

        return Response::json([
            'message' => 'Category update', 'new_name' => $request['name']
        ], 200);

    }

    public function deleteCategory($category_id){
        $category = Category::find($category_id);
        $category->delete();

        return Response::json(['message' => 'category deleted'], 200);
    }
}
