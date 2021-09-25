<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\PDF;



class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function dashboard()
    {
        if (auth()->user()->roles->first()->name == "Customer") {

            $billing_details = BillingDetail::where('user_id', Auth::id())->get();
            // $payment_method = BillingDetail::where('payment_method',)
            return view('backend.customer_dashboard', compact('billing_details'));
        }
        return view('backend.dashboard');
    }
    public function downloadCustomerInvoice(BillingDetail $billing_detail)
    {
        // return $billing_detail->getOrderAmount->getOrderedProduct;
        set_time_limit(1800);
        $customPaper = array(0, 0, 1191, 842);
        $pdf = PDF::loadView('backend.invoice.pdf', compact('billing_detail'));
        return $pdf->download('invoice' . now() . Str::random() . 'id-' . $billing_detail->id . '.pdf');
    }


    public function viewCustomerInvoice(BillingDetail $billing_detail)
    {
        return view('backend.invoice.pdf', compact('billing_detail'));
    }
}
