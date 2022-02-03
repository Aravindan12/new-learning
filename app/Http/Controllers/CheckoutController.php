<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function cart(){
        $cartItems = Cart::all();
        return view('cart',compact('cartItems'));
    }
    public function checkout(Request $request)
    {   
        // Enter Your Stripe Secret
        $key = config('app.stripe_key');
        \Stripe\Stripe::setApiKey($key);
        		
		$amount = $request->amount;
		$amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => $request->currency,
			'description' => 'Payment From Nowhere',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;
        $amount = $amount/100;
		return view('checkout.credit-card',compact('intent','amount'));

    }

    public function afterPayment()
    {
        echo 'Payment Has been Received';
    }
}
