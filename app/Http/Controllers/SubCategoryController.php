<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function Subcategories()
    {
        $subcats = SubCategory::paginate(10);
        return view('backend.subcategory.subcategory', compact('subcats'));
    }
    public function AddSubcategories()
    {
        return view('backend.subcategory.subcategory_form');
    }
    public function PostSubcategories()
    {
        return back();
    }
}
