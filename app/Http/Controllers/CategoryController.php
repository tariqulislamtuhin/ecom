<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function Category(){
        $data = Category::all();
        return view('backend.category.category_view',compact('data'));
    }

    function CategoryForm(){
        
        return view('backend.category.category_form');
    }
    function PostCategory(Request $request){
        
        // return $request->all();
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->slug = str::slug($request->category_name);
        $category->save();
        // return back();
        return redirect()->action([CategoryController::class,'Category']);
    }
}
