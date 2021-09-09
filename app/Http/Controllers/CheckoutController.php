<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'iscustomer']);
    }
    public function checkout()
    {
        $user = Auth::user();
        return view('frontend.pages.checkout', compact('user', 'countries'));
    }

    //
}
