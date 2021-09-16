<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Atrribute;
use App\Models\Billing_Detail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order_detail;
use App\Models\Order_Summery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Igaster\LaravelCities\Geo;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{

    // "city" => Geo::findorFail($checkrequest->city)->name,
    // "district" => Geo::findorfail($checkrequest->district)->name,
    // "thana" => Geo::findorfail($checkrequest->thana)->name,



    public function __construct()
    {
        $this->middleware(['auth', 'iscustomer']);
    }
    public function checkout()
    {
        $user = Auth::user();
        $countries = Geo::getCountries();
        return view('frontend.pages.checkout', compact('user', 'countries'));
    }

    public function store(CheckoutRequest $checkrequest)
    {
        $sessionData = [
            'coupon' => session()->get('s_coupon'),
            'subtotal' => round(session()->get('s_subtotal')),
            'discount' => session()->get('s_discount'),
            'total' =>   round(session()->get('s_total')),
        ];
        // return $sessionData;
        $billing_detail = Billing_Detail::create($checkrequest->except('_token', 'country') + [
            "user_id" => Auth::id(),
            "country" => Geo::Country($checkrequest->country)->level(Geo::LEVEL_COUNTRY)->orderBy('population', 'DESC')->first()->name,

        ]);

        if (session()->get('s_coupon')) {
            $order_detail = Order_detail::create([
                "billing_id" => $billing_detail->id,
                'coupon' => session()->get('s_coupon'),
                'subtotal' => round(session()->get('s_subtotal')),
                'discount' => session()->get('s_discount'),
                'total' =>   round(session()->get('s_total')),
            ]);
            Coupon::where("coupon_name", $order_detail->coupon)->decrement("coupon_limit", 1);
        } else {
            $order_detail = Order_detail::create([
                "billing_id" => $billing_detail->id,
                'coupon' => "null",
                'subtotal' => round(session()->get('s_subtotal')),
                'discount' => session()->get('s_discount'),
                'total' =>   round(session()->get('s_total')),
            ]);
        }

        foreach (Cart::where("cookie_id", Cookie::get('cookie_id'))->get() as $cart) {
            $order_summery = Order_Summery::create([
                "billing_id" => $billing_detail->id,
                "order_detail_id" => $order_detail->id,
                "product_id" => $cart->product_id,
                "color_id" => $cart->color_id,
                "size_id" => $cart->size_id,
                "quantity" => $cart->quantity,
            ]);
            Atrribute::where([
                "product_id" => $cart->product_id,
                "color_id" => $cart->color_id,
                "size_id" => $cart->size_id,
            ])->decrement("quantity", $cart->quantity);
            $cart->delete();
            return redirect()->route('checkout.finish');
        }
    }

    public function checkoutFinish()
    {
        return view('frontend.pages.checkout_finish');
    }

    #################### Ajax Methods Start From Here ###############

    public function getCityList(Request $request)   //  Ajax Response Method
    {
        $cityList = Geo::Country($request->country_code)
            ->level(Geo::LEVEL_1)
            ->orderBy('population', 'DESC')
            ->get();
        // $options = "<option value=" . "> --Select One-- </option>";
        // foreach ($cityList as $city) {
        //     $options .= "<option value=" . $city->id . ">" . $city->name . "</option>";
        // }
        // echo $options;
        return response()->json($cityList);
    }
    public function getDistrictList(Request $request)
    {
        $District_List = Geo::Country($request->country_code)->where('parent_id', $request->city_id)->orderBy('name', 'ASC')->get();
        return response()->json($District_List);
    }
    public function getTownList(Request $request)
    {
        $town_List = Geo::Country($request->country_code)->where('parent_id', $request->district_id)->orderBy('name', 'ASC')->get();
        return response()->json($town_List);
    }
}
