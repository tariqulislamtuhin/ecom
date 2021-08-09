<?php

use App\Models\Atrribute;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

function cart_total_count()
{
    return Cart::where('cookie_id', Cookie::get('cookie_id'))->count();
}

function cart_Get()
{
    return Cart::where('cookie_id', Cookie::get('cookie_id'))->get();
}

function getproductPrice($p_id, $c_id, $s_id)
{
    return Atrribute::where('product_id', $p_id)->where('color_id', $c_id)->where('size_id', $s_id)->first();
}
