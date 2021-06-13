<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function Subcategories()
    {
        $subcats = SubCategory::paginate(10);
        $cats = Category::all();
        return view('backend.subcategory.subcategory', compact('subcats', 'cats'));
    }
    public function AddSubcategories()
    {
        $cats = Category::orderBy('category_name', 'asc')->get();
        return view('backend.subcategory.subcategory_form', compact('cats'));
    }
    public function PostSubcategories(Request $req)
    {
        $req->validate([
            'subcategory_name' => 'required|min:3|unique:sub_categories',
            'category_id' => 'required',
        ]);

        $sub = new SubCategory();
        $sub->subcategory_name = $req->subcategory_name;
        $sub->slug = Str::Slug($req->slug);
        $sub->category_id = $req->category_id;
        $sub->save();
        return back();
    }
}
