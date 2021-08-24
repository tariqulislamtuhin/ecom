<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    ####### Nullable Method #######
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

        if ($request->hasCookie('cookie_id')) {
            $random_generated_coockie_id = $request->cookie('cookie_id');
            $cart_before = Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', $random_generated_coockie_id)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->exists();

            if ($cart_before) {
                $cart_before->increment('quantity', $request->quantity);
                return redirect()->action([CartController::class, 'cartview']);
            } else {
                $cart = new Cart();
                $cart->cookie_id = $random_generated_coockie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                $cart->color_id = $request->color_id;
                $cart->size_id = $request->size_id;
                $cart->size_id = now();
                $cart->save();
                return redirect()->action([CartController::class, 'cartview']);
            }
        } else {
            $random_generated_coockie_id = time() . Str::random(10);
            Cookie::queue('cookie_id', $random_generated_coockie_id, 1440);
            $cart = new Cart();
            $cart->cookie_id = $random_generated_coockie_id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();
            return back();
        }
    }

    public function DeleteCart(Cart $cart)
    {
        $cart->delete();
        return back();
    }
}
