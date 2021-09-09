<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datas = Category::with('getProducts')->orderBY('created_at', 'desc')->paginate(10);
        return view('backend.category.index', compact('datas'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required| min:3 | unique:categories',
            'slug' => 'required|unique:categories',
        ]);

        Category::firstOrCreate($request->except('_token'));
        return redirect()->route('category.index')->with("success", "Added Successfully.");
    }

    public function show(Category $category)
    {
        return view('backend.category.show', compact('category'));
    }
    public function destroy(Category $category)
    {
        // $cat =  Category::with('getSubcategories')->find($id);
        if ($category->getSubcategories->count() < 1) {
            $category->delete();
            return back()->with("success", "Category deleted succesfully");
        } else {
            return back()->with("error", "Cant delete Category");
        }
    }

    public function edit(Category $category)
    {
        return view("backend.category.edit", compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $category->update([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name)
        ]);

        return redirect()->action([CategoryController::class, 'index'])->with("success", "Category Updated Succesfull");;
    }

    public function trash()
    {
        // $datas = Category::onlyTrashed('deleted_at', 'desc')->paginate(10);
        return view("backend.category.trash", [
            'datas' => Category::onlyTrashed('deleted_at', 'desc')->paginate(10),
        ]);
    }


    function RestoreCategory($id)
    {
        Category::onlyTrashed()->findorfail($id)->restore($id);
        return back();
    }

    function PermanentDeleteCategory($id)
    {
        Category::onlyTrashed()->findorFail($id)->forceDelete();
        return back()->with("success", "Delete completed");
    }
}
