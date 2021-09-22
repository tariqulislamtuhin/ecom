<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     *
     * Nullable Method
     *
     */
    public function CartView($coupon_name = null)
    {
        if ($coupon_name == null) {

            $discount = 0;
            $carts = Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', Cookie::get('cookie_id'))->get();
            return view('frontend.pages.cart_view', compact('carts', 'discount', 'coupon_name'));
        }
        ############## Coupon Name Check ##############
        if (Coupon::where('coupon_name', $coupon_name)->exists()) {

            ############## Coupon Date Check ##############
            if (Coupon::where('coupon_name', $coupon_name)->whereDate('coupon_validity', '>=', now()->format('Y-m-d'))->exists()) {

                ############## Coupon Limit Check ##############
                if (Coupon::where('coupon_name', $coupon_name)->where('coupon_limit', '>', 0)->exists()) {

                    $discount = Coupon::where('coupon_name', $coupon_name)->whereDate('coupon_validity', '>=', now()->format('Y-m-d'))
                        ->where('coupon_limit', '>', 0)->first()->coupon_amount;
                    $carts = Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', Cookie::get('cookie_id'))->get();
                    return view('frontend.pages.cart_view', compact('carts', 'discount', 'coupon_name'));
                }
                return redirect('/carts/#coupon_section')->with('coupon_error', 'This Coupon exceeded The limit!');
            }
            return redirect('/carts/#coupon_section')->with('coupon_error', 'Sorry! Coupon is Expired!');
        }
        return redirect('/carts/#coupon_section')->with('coupon_error', 'Coupon is invalid.!');
    }

    /**
     *
     * Store cart here
     *
     * **/
    public function CartPost(Request $request)
    {
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required'
        ], [
            'color_id.required' => 'Please! Choose a color',
            'size_id.required' => 'Please! Choose a size'
        ]);

        // return $request->all();
        if ($request->hasCookie('cookie_id')) {
            // return $request->cookie('cookie_id');
            $random_generated_coockie_id = $request->cookie('cookie_id');

            $ok = Cart::where([
                "cookie_id" => $random_generated_coockie_id,
                "product_id" => $request->product_id,
                "color_id" => $request->color_id,
                "size_id" => $request->size_id
            ])->exists();
            // return $ok;
            if ($ok) {
                Cart::where([
                    "cookie_id" => $random_generated_coockie_id,
                    "product_id" => $request->product_id,
                    "color_id" => $request->color_id,
                    "size_id" => $request->size_id
                ])->first()->increment('quantity', $request->quantity);
                return redirect()->route('CartView');
            } else {
                $cart = Cart::create([
                    "cookie_id" => $random_generated_coockie_id,
                    "product_id" => $request->product_id,
                    "color_id" => $request->color_id,
                    "size_id" => $request->size_id,
                    "quantity" => $request->quantity,
                ]);
                return back();
            }
        } else {
            $random_generated_coockie_id = time() . Str::random(10);
            Cookie::queue('cookie_id', $random_generated_coockie_id, 1440);
            $cart = Cart::create([
                "cookie_id" => $random_generated_coockie_id,
                "product_id" => $request->product_id,
                "color_id" => $request->color_id,
                "size_id" => $request->size_id,
                "quantity" => $request->quantity,
            ]);
            return back();
        }
    }

    public function DeleteCart(Cart $cart)
    {
        $cart->delete();
        return back();
    }

    /**
     * Update Quantity
     */
    public function updateCart(Request $request, Cart $cart)
    {
        $cart->quantity = $request->quantity;
        $cart->save();
        return back();
    }
}
