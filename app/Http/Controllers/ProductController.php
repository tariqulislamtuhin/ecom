<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function ViewProducts()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.Product.products_view', compact('products'));
    }

    public function AddProduct()
    {
        $cats = Category::all();
        return view('backend.Product.product_form', compact('cats'));
    }
    public function PostProduct(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'title' => 'max:255|required|unique:products',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'summery' => 'required|min:10|max:255',
        ]);

        $slug = str::slug($request->title);
        $products = new product();
        $products->title  = $request->title;
        $products->slug = $slug;
        $products->category_id  = $request->category_id;
        $products->subcategory_id  = $request->subcategory_id;
        $products->summery  = $request->summery;
        $products->description  = $request->description;

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();
            // $location = public_path() . '/nefolder/image' . $name;          #New Folder Create korte Dey na
            // File::makeDirectory($location, 0777, true, true);
            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $products->thumbnail  = $name;
        }
        $products->save();
        return redirect()->action([ProductController::class, "AddProduct"])->with('success', 'Product Added Succesfully');
    }


    public function GetSubCat($id)                  // Here API 
    {
        $scat = SubCategory::where('category_id', $id)->get();
        return response()->json($scat);
    }

    public function DeleteProduct($slug)
    {

        Product::where('slug', $slug)->first()->delete();
        return redirect()->action([ProductController::class, "ViewProducts"])->with('success', 'Product deleted.');
    }
    public function EditProduct($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $cats = Category::all();
        $scat = SubCategory::where('id', $product->subcategory_id)->get();
        return view('backend.Product.edit_product_form', compact('product', 'cats', 'scat'));
    }

    public function UpdateProduct(Request $request)
    {
        $slug = str::slug($request->title);
        $product = Product::findorFail($request->product_id);
        $product->title = $request->title;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->summery = $request->summery;
        $product->description = $request->description;
        // $product->thumbnail = $request->thumbnail;

        if ($request->hasFile('thumbnail')) {

            $image = $request->file('thumbnail');
            $old_img = \public_path('thumb/') . $product->thumbnail;

            if (file_exists($old_img)) {
                unlink($old_img);
                return 'done';
            }
            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();
            # $location = public_path() . '/nefolder/image' . $name;          #New Folder Create korte Dey na#
            # File::makeDirectory($location, 0777, true, true);
            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $product->thumbnail  = $name;
        }
        $product->save();

        return redirect()->action([ProductController::class, 'products'])->with('success', 'Product succesfully Updated');
    }
    public function TrashedProduct()
    {
        $products = product::onlyTrashed('deleted_at', 'desc')->paginate(10);
        return view('backend.Product.trashed_products', compact('products'));
    }
}
