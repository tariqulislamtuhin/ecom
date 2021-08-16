<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.coupon.index', [
            "Coupons" => Coupon::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.coupon.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required | unique:coupons,coupon_name',
            'coupon_amount' => 'required|numeric|between:0,99',
            'coupon_validity' => 'required|date',
            'coupon_limit' => 'required|numeric',
        ]);
        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_amount = $request->coupon_amount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->save();
        return redirect()->action([CouponController::class, 'index'])->with('success', 'Coupon Has been Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view("backend.coupon.show", compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view("backend.coupon.edit", compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name,' . $coupon->id,
        ]);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_amount = $request->coupon_amount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->save();
        return redirect()->action([CouponController::class, "index"])->with("success", "Coupon Updated Succesfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back();
    }
    public function trash()
    {
        $trashcoupons = Coupon::onlyTrashed()->paginate(10);
        return view('backend.coupon.trash', compact('trashcoupons'));
    }

    public function restore($id)
    {
        Coupon::onlyTrashed()->findorFail($id)->restore($id);
        return back();
    }

    public function clean($id)
    {
        Coupon::withTrashed()->findOrFail($id)->forceDelete($id);
        return back();
    }
}
