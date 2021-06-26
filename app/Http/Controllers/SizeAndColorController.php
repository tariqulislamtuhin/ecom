<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeAndColorController extends Controller
{
    //
    public function CreateSize()
    {
        $datas = Size::orderBy('created_at', 'desc')->paginate(3);
        return view('backend.SizeAndColor.Sizes_view', compact('datas'));
    }
    public function PostSize(Request $request)
    {
        $request->validate([

            'size_name' => 'required',
        ]);

        $size = new Size();
        $size->size_name = $request->size_name;
        $size->slug = Str::slug($request->size_name . " size ");
        $size->save();
        return back();
    }


    public function CreateColor()
    {
        $datas = color::orderBy('created_at', 'desc')->paginate(3);
        return view('backend.SizeAndColor.color_view', compact('datas'));
    }
    public function PostColor(Request $request)
    {
        $request->validate([

            'color_name' => 'required',
        ]);

        $color = new color();
        $color->color_name = $request->color_name;
        $color->slug = Str::slug('it is ' . $request->color_name);
        $color->save();
        return back();
    }
}
