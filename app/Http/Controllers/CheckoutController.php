<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Atrribute;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\OrderAmount;
use App\Models\OrderedProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Igaster\LaravelCities\Geo;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    /**
     *
     *  "city" => Geo::findorFail($request->city)->name,
     *  "district" => Geo::findorfail($request->district)->name,
     *  "thana" => Geo::findorfail($request->thana)->name,
     *
     *  */

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

    public function store(CheckoutRequest $request)
    {
        ($request->country == 'BD') ? session()->put('s_shipping', 120) : session()->put('s_shipping', 500);
        // return $request->all();
        $billing_detail = BillingDetail::create($request->except('_token', 'country') + [
            "user_id" => Auth::id(),
            "country" => Geo::Country($request->country)->level(Geo::LEVEL_COUNTRY)->orderBy('population', 'DESC')->first()->name,
        ]);

        $order_ammount = OrderAmount::create([
            "billing_detail_id" => $billing_detail->id,
            'coupon' => session('s_coupon'),
            'subtotal' => round(session()->get('s_subtotal')),
            'discount' => session()->get('s_discount'),
            'shipping' => session('s_shipping'),
            'total' => round(session()->get('s_total')) + session('s_shipping'),
        ]);

        if (session('s_coupon')) {
            Coupon::where("coupon_name", $order_ammount->coupon)->decrement("coupon_limit", 1);
        }

        foreach (Cart::where("cookie_id", Cookie::get('cookie_id'))->get() as $cart) {

            OrderedProduct::insert([
                "order_amount_id" => $order_ammount->id,
                "product_id" => $cart->product_id,
                "color_id" => $cart->color_id,
                "size_id" => $cart->size_id,
                "quantity" => $cart->quantity,
                "created_at" => Carbon::now(),
            ]);
            Atrribute::where([
                "product_id" => $cart->product_id,
                "color_id" => $cart->color_id,
                "size_id" => $cart->size_id,
            ])->decrement("quantity", $cart->quantity);
            $cart->delete();
        }
        session()->forget('s_coupon');
        session()->forget('s_subtotal');
        session()->forget('s_discount');
        session()->forget('s_shipping');
        session()->forget('s_total');
        return redirect()->route('checkout.finish');
    }

    public function checkoutFinish()
    {
        return view('frontend.pages.checkout_finish');
    }

    #################### Ajax Methods Start From Here ###############
    /**
     *
     * $options = "<option value=" . "> --Select One-- </option>";
     * foreach ($cityList as $city) {
     *  $options .= "<option value=" . $city->id . ">" . $city->name . "</option>";
     *
     * }
     * echo $options;
     *
     *  */


    public function getCityList(Request $request)   //  Ajax Response Method
    {
        $cityList = Geo::Country($request->country_code)
            ->level(Geo::LEVEL_1)
            ->orderBy('population', 'DESC')
            ->get();
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
