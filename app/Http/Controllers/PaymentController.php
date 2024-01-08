<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Models\Cart;
use App\Models\discount;
use App\Models\order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
  public function checkOut()
  {
    $user_id = Auth::user()->id;
    $carts = Cart::where('user_id', $user_id)->where('status', 0)->get();
    $discounts = discount::where('is_active', 1)->get();
    return view('users.checkout', compact('carts', 'discounts'));
  }

  public function index(Request $request)
  {
    $order = Order::where('user_id', Auth::user()->id)->where('is_paid', 0)->first();
    if ($order == null) {
      $order = new Order;
      $order->user_id = auth()->user()->id;
      $order->total_amount = $request->totalamount;
      $order->discount = 0;
      $order->is_paid = 0;
      $order->save();

    }
    $totalAmount = $order->total_amount -  $order->discount + $order->delivery_fee;
    if ($totalAmount == null) {
      $totalAmount = $order->total_amount;
    }

    Stripe::setApiKey("sk_test_51OEpw8SGdg31XPfvy9e0qUvdDyFoVdsb7nVGdSm7AxjBOFtItwwVKLXaTJTfUjpzeR6Xdhb7XRALbudz2BpH1kDc009F50Vcwl");

    $success = route('success') . '?session_id={CHECKOUT_SESSION_ID}';
    $cancel = route('cancel');

    $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

    $checkout_session = \Stripe\Checkout\Session::create([
      'payment_method_types' => ['card'],
      'line_items' => [
        [
          'price_data' => [
            'currency' => 'inr',
            'product_data' => [
              'name' => 'Blue-Shoes',
            ],
            'unit_amount' => (int) ($totalAmount * 100),
          ],
          'quantity' => 1,
        ]
      ],
      'mode' => 'payment',
      'success_url' => $success,
      'cancel_url' => $cancel,
    ]);
    // dd(1111);

    $order->is_paid = 2;
    $order->save();


    return redirect($checkout_session->url);

  }


  public function success(Request $request)
  {
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $sessionId = $request->input('session_id');

    try {
      $session = \Stripe\Checkout\Session::retrieve($sessionId);

      $paymentIntentId = $session->payment_intent;

    } catch (\Exception $e) {
      dd($e->getMessage());
    }
    $user_id = auth()->user()->id;

    $payment = new Payment;
    $payment->user_id = $user_id;
    $payment->stripe_payment_intent_id = $paymentIntentId;
    $payment->total_amount = $session->amount_total;
    $payment->is_paid = 1;
    $payment->save();

    $order = order::where('user_id', Auth::user()->id)->where('is_paid', 2)->first();
    $order->is_paid = 1;
    $order->save();



    if ($payment != null) {
      $carts = Cart::where('user_id', $user_id)->get();
      $orders = OrderDetail::all();
      $orderDetails = [];

      foreach ($carts as $cart) {
        $confirm_order = OrderDetail::where('product_id', $cart->product_id)->first();

        if ($confirm_order != null) {
          $confirm_order = OrderDetail::where('product_id', $cart->product_id)->first();
          $confirm_order->qauntity = $confirm_order->qauntity + $cart->quantity;
          $confirm_order->save();
          $cart->delete();
        } else {
          $confirm_order = new OrderDetail;
          $confirm_order->user_id = $cart->user_id;
          $confirm_order->product_id = $cart->product_id;
          $confirm_order->qauntity = $cart->quantity;
          $confirm_order->save();
          $cart->delete();

        }
        $orderDetails[] = [
          'product_name' => $cart->product->name,
          'quantity' => $cart->quantity,
          // Add more fields as needed
        ];
      }
      Mail::to('hemilsojitra944@gmail.com')->send(new NotifyMail($orderDetails));
    }

    return view('success');
  }


  // payment cancel
  public function cancel()
  {
    return view('cancel');
  }
  public function abc(Request $request)
  {        
    dd($request->all());
  }

  /**
   * Write code on Method
   *
   * @return response()
   */

   public function store(Request $request)
   {
    // dd(1111111);
       try {
           // Check if the necessary keys exist in the request
           if (!$request->has('razorpay_payment_id')) {
               throw new \InvalidArgumentException("Missing 'razorpay_payment_id' in the request.");
           }

           // Access the razorpay_payment_id
           $razorpayPaymentId = $request->input('razorpay_payment_id');

           // Your other logic here

           // Log success or any other relevant information
           Log::info('Payment success. Razorpay Payment ID: ' . $razorpayPaymentId);

           // Return a response (you can customize this based on your needs)
           return response()->json(['message' => 'Payment successful'], 200);
       } catch (\Exception $e) {
           // Log the error
           Log::error('Payment processing error: ' . $e->getMessage());

           // Return an error response (you can customize this based on your needs)
           return response()->json(['error' => $e->getMessage()], 500);
       }
   }
  }
