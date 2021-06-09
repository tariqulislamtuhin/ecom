<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function Category()
    {
        $datas = Category::OrderBY('created_at', 'desc')->paginate(10);
        return view('backend.category.category_view', compact('datas'));
    }

    function CategoryForm()
    {

        return view('backend.category.category_form');
    }

    function PostCategory(Request $request)
    {

        // return $request->all();
        $request->validate([
            'category_name' => 'required| min:3 | unique',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->slug = str::slug($request->category_name);
        $category->save();
        // return back();
        return redirect()->action([CategoryController::class, 'CategoryForm'])->with("success", "Added Successfully.");
    }

    function DeleteCategory($id)
    {
        Category::findorFail($id)->delete();
        return back()->with("success", "Category deleted succesfully");
    }

    function EditCategory($id)
    {
        $data = Category::findorFail($id);
        return view("backend.category.edit_category_form", compact('data'));
    }
    function UpdateCategory(Request $request)
    {
        $updcat = Category::findorFail($request->cat_id);
        $updcat->category_name = $request->category_name;
        $updcat->slug = Str::slug($request->category_name);
        $updcat->save();
        // return redirect("backend.category.categor")->with();
        return redirect()->action([CategoryController::class, 'Category'])->with("success", "Category Updated Succesfull");;
    }

    function TrashCategory()
    {
        $datas = Category::onlyTrashed('deleted_at', 'desc')->paginate(10);
        return view("backend.category.trashed_categories", compact('datas'));
    }


    function RestoreCategory($id)
    {
        Category::onlyTrashed()->findorFail($id)->restore($id);
        return redirect("trashed-categories")->with("success", "restored completed");
    }

    function PermanentDeleteCategory($id)
    {
        Category::onlyTrashed()->findorFail($id)->forceDelete();
        return redirect("/trashed-categories")->with("success", "Delete completed");
    }
}
