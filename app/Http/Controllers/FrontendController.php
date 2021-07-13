<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // public function Frontend()
    // {
    //     return view('frontend.master');
    // }

    function about()
    {

        return view('pages.about', [
            'var' => 'About pages',
        ]);
    }
    function contact()
    {

        return view('pages.contact', [
            'var' => 'Contact pages',
        ]);
    }
}
