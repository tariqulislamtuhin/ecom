<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function Category(){
        return view('backend.category.category_view');
    }

    function CategoryForm(){
        
        return view('backend.category.category_form');
    }
    function PostCategory(Request $request){
        
        // return $request->all();
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->slug = $request->slug;
        // $category->save();
        return redirect()->action([CategoryController::class,'CategoryForm']);
    }
}
