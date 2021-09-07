<?php

use App\Models\Atrribute;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

function countCarts()
{
    return Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', Cookie::get('cookie_id'))->count();
}

function getCarts()
{
    return Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', Cookie::get('cookie_id'))->get();
}

function getproductPrice($p_id, $c_id, $s_id)
{
    return Atrribute::with(['getColor', 'Products', 'getSize'])->where('product_id', $p_id)->where('color_id', $c_id)->where('size_id', $s_id)->first();
}
function discountTotal($total, $discount)
{
    return ($total * $discount) / 100;
}
