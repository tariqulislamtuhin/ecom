<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\Category;
use App\Models\color;
use App\Models\product;
use App\Models\Size;
use App\Models\SubCategory;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Throwable;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\fileExists;
use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function ViewProducts()
    {
        $products = Product::with(['getcategory', 'getSubCategory', 'Atrribute'])->paginate(10);
        return view('backend.Product.products_view', compact('products'));
    }

    public function ProductForm()
    {
        return view('backend.Product.product_form', [
            'cats' => Category::all(),
            'colors' => color::all(),
            'sizes' => Size::all(),

        ]);
    }
    public function AddProduct(Request $request)
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

        // $save_location = public_path('thumbnail/') . $products->created_at()->format('Y/M/') . $products->id;
        // File::makeDirectory($save_location, 0777, true, true);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $products->thumbnail  = $name;
        }
        $products->save();

        if ($request->hasFile('image')) {

            $images = $request->file('image');

            foreach ($request->color_id as $key => $color) {
                $attr = new Atrribute();
                $attr->product_id = $products->id;
                $attr->color_id = $color;
                $attr->size_id = $request->size_id[$key];
                $attr->quantity = $request->quantity[$key];
                $attr->regular_price = $request->regular_price[$key];
                $attr->sale_price = $request->sale_price[$key];
                $attr->image = $products->title . $products->id . strtolower(Str::random(4)) . '.' . $images[$key]->getClientOriginalExtension();
                Image::make($images[$key])->save(\public_path('images/' . $attr->image), 70);
                $attr->save();
            }
        }
        return redirect()->action([ProductController::class, "ProductForm"])->with('success', 'Product Added Succesfully');
    }

    ############ Here API ############

    public function GetSubCat($id)
    {

        $scat = SubCategory::where('category_id', $id)->get();
        return response()->json($scat);
    }


    public function DeleteProduct(product $product)
    {

        $product->delete();
        return redirect()->action([ProductController::class, "ViewProducts"])->with('success', 'Product deleted.');
    }

    # This code for force delete
    // $old_image = \public_path("thumb/") . $product->thumbnail;
    // if (fileExists($old_image)) {
    //     unlink($old_image);
    // }

    public function EditProduct(product $product)
    {

        $cats = Category::all();
        $scat = SubCategory::where('id', $product->subcategory_id)->get();
        $colors = color::all();
        $sizes = Size::all();
        // return $product->Atrribute;
        return view('backend.Product.edit_product_form', compact('product', 'cats', 'scat', 'colors', 'sizes'));
    }

    ############## Product Update ##############

    public function UpdateProduct(Request $request, product $product)
    {
        $slug = str::slug($request->title);
        $product->title = $request->title;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->summery = $request->summery;
        $product->description = $request->description;

        if ($request->hasFile('thumbnail')) {

            $image = $request->file('thumbnail');
            $old_img = \public_path('thumb/') . $product->thumbnail;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();

            // $location = public_path() . '/nefolder/image' . $name;
            // File::makeDirectory($location, 0777, true, true);

            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $product->thumbnail  = $name;
        }
        if ($request->hasFile('thumbnail')) {

            $image = $request->file('thumbnail');
            $old_img = \public_path('thumb/') . $product->thumbnail;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();

            ##############   $location = public_path() . '/nefolder/image' . $name; ##############
            ##############  File::makeDirectory($location, 0777, true, true);      ##############

            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $product->thumbnail  = $name;
        }
        if ($request->hasFile('thumbnail')) {

            $image = $request->file('thumbnail');
            $old_img = \public_path('thumb/') . $product->thumbnail;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();

            ##############   $location = public_path() . '/nefolder/image' . $name; ##############
            ##############  File::makeDirectory($location, 0777, true, true);      ##############

            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $product->thumbnail  = $name;
        }
        if ($request->hasFile('thumbnail')) {

            $image = $request->file('thumbnail');
            $old_img = \public_path('thumb/') . $product->thumbnail;

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            $name = $slug . '-' . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();

            ##############   $location = public_path() . '/nefolder/image' . $name; ##############
            ##############  File::makeDirectory($location, 0777, true, true);      ##############

            Image::make($image)->save(\public_path('thumb/' . $name), 70);
            $product->thumbnail  = $name;
        }
        $product->save();

        ############## Edit Image Attribute Section ##############

        if ($request->hasFile('image')) {

            $images = $request->file('image');

            foreach ($images as $key => $image) {
                $attr = Atrribute::findorFail($request->att_id[$key]);
                $old_path = public_path('images/' . $attr->image);
                if (!empty($request->image[$key])) {

                    if (file_exists($old_path)) {

                        unlink($old_path);
                    }
                    $attr->image = $product->title . $product->id . strtolower(Str::random(4)) . '.' . $image->getClientOriginalExtension();
                    Image::make($images[$key])->save(\public_path('images/' . $attr->image), 70);
                }

                $attr->save();
            }
        }


        ############## Edit Attribute Section ##############

        foreach ($request->color_id as $key => $color) {

            $attr = Atrribute::findorFail($request->att_id[$key]);
            $attr->product_id = $product->id;
            $attr->color_id = $color;
            $attr->size_id = $request->size_id[$key];
            $attr->quantity = $request->quantity[$key];
            $attr->regular_price = $request->regular_price[$key];
            $attr->sale_price = $request->sale_price[$key];
            $attr->save();
        }
        ############## New Attribute Section ##############

        if ($request->hasFile('update_image')) {

            $images = $request->file('update_image');
            foreach ($request->update_color_id as $key => $val) {

                // try {

                if ($val != null && $request->update_quantity[$key] != null) {

                    $attr = new Atrribute();
                    $attr->product_id = $product->id;
                    $attr->color_id = $val;
                    $attr->size_id = $request->update_size_id[$key];
                    $attr->quantity = $request->update_quantity[$key];
                    $attr->regular_price = $request->update_regular_price[$key];
                    $attr->sale_price = $request->update_sale_price[$key];
                    $attr->image = $product->title . $product->id . strtolower(Str::random(4)) . '.' . $images[$key]->getClientOriginalExtension();
                    Image::make($images[$key])->save(\public_path('images/' . $attr->image), 70);
                    $attr->save();
                }
                // } catch (Throwable $e) {

                //     return redirect()->action([ProductController::class, 'ViewProducts'])->with('error', $e);
                // }
            }
        } else {
            foreach ($request->update_color_id as $key => $val) {

                // try {

                if ($val != null && $request->update_quantity[$key] != null) {

                    $attr = new Atrribute();
                    $attr->product_id = $product->id;
                    $attr->color_id = $val;
                    $attr->size_id = $request->update_size_id[$key];
                    $attr->quantity = $request->update_quantity[$key];
                    $attr->regular_price = $request->update_regular_price[$key];
                    $attr->sale_price = $request->update_sale_price[$key];
                    $attr->image = $product->title . $product->id . strtolower(Str::random(4)) . '.' . 'png';
                    Image::make($images[$key])->save(\public_path('images/' . $attr->image), 70);
                    $attr->save();
                }
                // } catch (Throwable $e) {

                //     return redirect()->action([ProductController::class, 'ViewProducts'])->with('error', $e);
                // }
            }
        }
        return back()->with('success', 'Product succesfully Updated');
        // return redirect()->action([ProductController::class, 'ViewProducts'])->with('success', 'Product succesfully Updated');
    }




    public function TrashedProduct()
    {
        $products = product::onlyTrashed('deleted_at', 'desc')->paginate(10);
        return view('backend.Product.trashed_products', compact('products'));
    }


    public function DeleteProductAttribute(Atrribute $atr)
    {
        $atr->delete();
        return back();
    }

    public function clean($id)
    {
        $pro_attri = Atrribute::Where('product_id', $id)->get();
        if (Atrribute::Where('product_id', $id)->exists())
            foreach ($pro_attri as $attr) {

                Atrribute::find($attr->id)->forceDelete($attr->id);
            }
        product::onlyTrashed()->find($id)->forceDelete($id);
        return back();
    }
}
