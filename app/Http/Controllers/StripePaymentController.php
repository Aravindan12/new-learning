<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Stripe;
use Session;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    //
    public function index()
    {
       return view('stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }
}
