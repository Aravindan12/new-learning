<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use \Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function retrievePlans() {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        
        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return $plans;
    }
    public function showSubscription() {
        $plans = $this->retrievePlans();
        $user = Auth::user();
        
        return view('seller.pages.subscribe', [
            'user'=>$user,
            'intent' => $user->createSetupIntent(),
            'plans' => $plans
        ]);
    }
    public function processSubscription(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
                    
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
            $user->newSubscription('default', $plan)->create($paymentMethod, [
                'email' => $user->email
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        
        return redirect('dashboard');
    }

    public function stripeDone(Request $request){
        
        $result = $this->processSubscription($request->stripeToken, $user);
        dd($result);
        // if ($result->success) {
        //     $amount = $request->amount2;
        //     $results = $this->currency_converter($request->currency_code, $toCurrencyCode, 10);
        //     $rate1 = $results->rates->{$toCurrencyCode};
        //     $stripe_charge = Payment::stripeCreateChargeNew($amount1, $result,$toCurrencyCode);

        //     if ($stripe_charge->success) {
        //         dd('done');
        //     }
        // }               
    }
}
