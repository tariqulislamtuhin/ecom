<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeAndColorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function CreateSize()
    {
        $datas = Size::orderBy('created_at', 'desc')->paginate(3);
        return view('backend.SizeAndColor.Sizes_view', compact('datas'));
    }

    public function PostSize(Request $request)
    {
        $request->validate([
            'size_name' => 'required|max:4|unique:sizes',
        ], [
            'max' => 'Please! enter Short term of sizes.',
            'unique' => 'This size already added. '
        ]);

        Size::create([
            'size_name' => Str::lower($request->size_name),
            'slug' => Str::slug($request->size_name . " size ")
        ]);
        return redirect('Size/create/#size_name');
    }


    public function CreateColor()
    {
        $datas = color::orderBy('created_at', 'desc')->paginate(3);
        return view('backend.SizeAndColor.color_view', compact('datas'));
    }

    public function PostColor(Request $request)
    {
        $request->validate([

            'color_name' => 'required|unique:colors',
        ], [
            'unique' => 'This color already added.'
        ]);

        color::create([
            "color_name" => Str::ucfirst($request->color_name),
            "slug" => Str::slug($request->color_name . ' size')
        ]);
        return back();
    }

    public function DeleteColor(color $color)
    {
        // return $color;
        // return Atrribute::where('color_id', $color->id)->exists();
        if (!Atrribute::where('color_id', $color->id)->exists()) {
            $color->delete();
            return back()->with('success', $color->color_name . ' Color Deleted succesfully');
        } else {
            return back()->with('error', $color->color_name . ' is in use.');
        }
    }
    public function DeleteSize(Size $size)
    {
        if (!Atrribute::where('size_id', $size->id)->exists()) {
            $size->delete();
            return back()->with('success', $size->slug . ' Size Deleted Succesfully');
        } else {
            return back()->with('error', $size->slug . ' is in use.');
        }
    }
}
