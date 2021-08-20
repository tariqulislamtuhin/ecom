<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function Subcategories()
    {
        return view('backend.subcategory.subcategory', [
            'subcategorys' => SubCategory::with(["Category", 'Product'])->paginate(10),
        ]);
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
            'slug' => 'required|min:3|unique:sub_categories',
            'category_id' => 'required',
        ]);

        $sub = new SubCategory();
        $sub->subcategory_name = $req->subcategory_name;
        $sub->slug = Str::Slug($req->slug);
        $sub->category_id = $req->category_id;
        $sub->save();
        return back()->with('success', 'subcategory added Succesfully');
    }

    public function editsubcategories(SubCategory $subcategory)
    {
        return view('backend.subcategory.subcategory_edit', compact('subcategory'));
    }

    public function updatesubcategories(Request $req, SubCategory $subcategory)
    {
        if (SubCategory::findorFail($subcategory->id)->where('id', '!=', $req->id)) {
            $subcategory->subcategory_name = $req->subcategory_name;
            $subcategory->slug = Str::slug($req->slug);
            $subcategory->save();
            return redirect()->action([SubCategoryController::class, 'Subcategories'])->with('success', 'edited successfully');
        } else {
            return back();
        }
    }
    public function Deletesubcategories(SubCategory $subcategory)
    {
        if (!Product::where('subcategory_id', $subcategory->id)->exists()) {
            $subcategory->delete();
            return redirect()->action([SubCategoryController::class, 'Subcategories'])->with('success', 'Deletation Successful.');
        }
        return redirect()->action([SubCategoryController::class, 'Subcategories'])->with("error", "Can't Delete.");
    }

    public function TrashSubCategory()
    {
        $deletedsubcategory = SubCategory::onlyTrashed('deleted_at', 'desc')->paginate(10);

        return view('backend.subcategory.trashed_subcategories', compact('deletedsubcategory'));
    }

    public function PermanentdeleteSubCategory($slug)
    {
        SubCategory::onlyTrashed()->where('slug', $slug)->first()->forceDelete();
        return redirect()->action([SubCategoryController::class, 'TrashSubCategory'])->with('success', 'delted sunccesful.');
    }

    public function PosstDeleteAllSubcategories(Request $req)
    {
        if (!empty($req->delete)) {

            if ($req->button == 'delete') {
                foreach ($req->delete as $value) {

                    SubCategory::onlyTrashed()->findorFail($value)->forceDelete();
                }
                return back()->with('success', 'Deletation successfull.');
            }
            if ($req->button == 'restore') {
                foreach ($req->delete as $restoreId) {

                    SubCategory::onlyTrashed()->findOrFail($restoreId)->restore($restoreId);
                }
                return back()->with('success', 'Restore successfull.');
            }
        } else {
            return back();
        }
    }

    public function PermanentrestoreSubCategory($slug)
    {
        SubCategory::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->action([SubCategoryController::class, 'TrashSubCategory'])->with('success', 'Restore sunccesful.');
    }
}
