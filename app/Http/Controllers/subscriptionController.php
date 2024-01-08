<?php

namespace App\Http\Controllers;

use App\Mail\subscribeCancellationMail;
use App\Mail\subscribeMail;
use App\Models\plan;
use App\Models\subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use \Stripe\Price;
use \Stripe\Product;
use Stripe\Stripe;

class subscriptionController extends Controller
{
    public function showpage()
    {
        $plans = plan::all();
        return view('subscription-list', compact('plans'));
    }

    public function payment(Request $request)
    {
        try {
            $plan = Plan::find($request->id);
            Stripe::setApiKey("sk_test_51OEpw8SGdg31XPfvy9e0qUvdDyFoVdsb7nVGdSm7AxjBOFtItwwVKLXaTJTfUjpzeR6Xdhb7XRALbudz2BpH1kDc009F50Vcwl");

            $success = route('subscription.payment.success', ['id' => $plan->id]) . '&session_id={CHECKOUT_SESSION_ID}';

            $cancel = route('cancel');

            $YOUR_DOMAIN = 'http://127.0.0.1:8000/';
            $price_id = $plan->plan_id;

            // Retrieve the price ID associated with the product
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $price_id,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription', // Use 'subscription' mode for recurring  
                'success_url' => $success,
                'cancel_url' => $cancel,
            ]);

            return redirect($checkout_session->url);


        } catch (\Exception $e) {
            // Log or dd() the exception for debugging
            dd($e->getMessage());
        }
    }

    // for payment success
    public function paymentSuccess(Request $request)
    {
        Stripe::setApiKey("sk_test_51OEpw8SGdg31XPfvy9e0qUvdDyFoVdsb7nVGdSm7AxjBOFtItwwVKLXaTJTfUjpzeR6Xdhb7XRALbudz2BpH1kDc009F50Vcwl");
        $sessionId = $request->session_id;

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        // Retrieve price details
        $priceId = Plan::find($request->id)->plan_id;
        $price = Price::retrieve($priceId);

        // Retrieve product details
        $productId = $price->product;
        $product = Product::retrieve($productId);

        // Retrieve customer details
        $customerId = $session->customer;
        $customer = Customer::retrieve($customerId);

        // find user on email
        $user = User::where('email', $customer->email)->first();

        $user = User::find(Auth::user()->id);
        $user->stripe_customer_id = $customerId;
        $user->is_subscribe = 1;
        $user->save();

        $subscriptions = new subscription;
        $subscriptions->user_id = $user->id;
        $subscriptions->plan_name = $product->name;
        $subscriptions->customer_id = $customerId;
        $subscriptions->payment_intent = $session->invoice;
        $subscriptions->status = $session->status;
        $subscriptions->duration = $price->recurring->interval;
        $subscriptions->price = $price->unit_amount / 100;
        // $subscriptions->is_paid = 1;
        $subscriptions->save();

        Mail::to('hemilsojitra69@gmail.com')->send(new subscribeMail());
        return view('success');

    }

    // for cancel sub
    public function sub_cancel()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $customerId = Auth::user()->stripe_customer_id;
        $customer = Customer::retrieve($customerId);

        // dd($customer->toArray());
        $subscriptions = $stripe->subscriptions->all(['customer' => $customer, 'limit' => 1]);
        $subscription_id = $subscriptions->data[0]->id;

        // Now cancel the subscription
        $stripe->subscriptions->update($subscription_id, ['cancel_at_period_end' => true]);

        $user = User::find(Auth::user()->id);
        $user->is_subscribe = 2;
        $user->save();

        // $cancellationDate = $subscriptions->current_period_end;

        $cancellationDetails = [
            'subscription_id' => $subscription_id,
            'date' => date('Y-m-d H:i:s', $subscriptions->current_period_end),  // Convert Unix timestamp to a date format
        ];

        Mail::to('hemilsojitra69@gmail.com')->send(new subscribeCancellationMail($cancellationDetails));
        return back()->with('success', 'Subscription canceled successfully.');
    }

    // For Cancel Cancellnasion sub 
    public function stopCancel()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        $customerId = Auth::user()->stripe_customer_id;
        $customer_id = Customer::retrieve($customerId);

        $subscriptions = $stripe->subscriptions->all(['customer' => $customer_id, 'limit' => 1]);
        $subscription_id = $subscriptions->data[0]->id;
        // dd($subscription_id);
        $stripe->subscriptions->update($subscription_id, ['cancel_at_period_end' => false]);
        $user = User::find(Auth::user()->id);
        $user->is_subscribe = 1;
        $user->save();

        $data = Carbon::today();
        $restorationDetails = [
            'subscription_id' => $subscription_id,
            'date' => $data,
        ];

        Mail::to('hemilsojitra69@gmail.com')->send(new subscribeCancellationMail($restorationDetails));
        return back()->with('success', 'Subscription restore successfully.');
    }
}