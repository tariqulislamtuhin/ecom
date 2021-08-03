<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Frontend()
    {
        return view('frontend.main', [
            "latests" => Product::with('Atrribute')->latest()->limit(10)->get(),
        ]);
    }
    public function ProductDetails($slug, $id)
    {
        $products = Product::with(['Atrribute', 'getCategory', 'getSubCategory'])->findOrFail($id)->where('slug', $slug)->first();
        $reletedProduct = Product::with(['Atrribute', 'getCategory', 'getSubCategory'])->where('id', '!=', $id)->where('category_id', $products->category_id)->get();
        $attribute = Atrribute::with(['Products', 'getColor', 'getSize'])->where('product_id', $products->id)->get();
        $grouped = $attribute->groupBy('color_id');
        // return $grouped->all();
        return view('frontend.pages.product_details', compact(['products', 'reletedProduct', 'grouped']));
    }

    public function GetProduct($color_id, $product_id)
    {
        $output = '';
        $sizes = Atrribute::with(['Products', 'getColor', 'getSize'])->where('product_id', $product_id)->where('color_id', $color_id)->get();
        foreach ($sizes as $key => $size) {
            $output = $output . '<input type="radio" data-quantity="' . $size->quantity . '" id="size" data-price="' . $size->sale_price . '" class="sizeCheck m-1" name="size_id" value="' . $size->id . '"> <label for="size">  ' . $size->getSize->size_name . '  </label>';
        }
        // return response()->json($sizes);
        echo $output;
    }
    public function CartView()
    {
        return view('frontend.pages.cart_view');
    }
    // function about()
    // {

    //     return view('pages.about', [
    //         'var' => 'About pages',
    //     ]);
    // }
    // function contact()
    // {

    //     return view('pages.contact', [
    //         'var' => 'Contact pages',
    //     ]);
    // }

}
