<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Customer;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use Stripe\Stripe;

class WebHooksController extends Controller
{
    public function handleWebhook(Request $request)
    {
        try {
            $payload = $request->getContent();
            $sigHeader = $request->server('HTTP_STRIPE_SIGNATURE');
            $secret = env('STRIPE_WEBHOOK_SECRET');
            
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (SignatureVerificationException $e) {
            Log::error('Webhook signature verification failed: ' . $e->getMessage());
            return response('Invalid signature.', 400);
        } catch (\Exception $e) {
            Log::error('Exception while processing webhook: ' . $e->getMessage());
            return response('Invalid payload', 400);
        }

        $eventType = $event->type;
         

        switch ($eventType) {
            case 'invoice.payment_succeeded':
                $this->handleSuccessfulPayment($event->data->object);
                break;
            case 'customer.subscription.deleted':
                $this->handleSubscriptionCancellation($event->data->object);
                break;
            default:
                // Handle other events if needed
        }

        return response('Webhook received successfully.');
    }

    private function handleSuccessfulPayment($paymentIntent)
    {
        try {
            $productId = $paymentIntent->lines->data[0]->plan->id;
            $data = Plan::where('plan_id', $productId)->first();

            $customerId = $paymentIntent->customer;
            $customer = Customer::retrieve($customerId);
            $user = User::where('email', $customer->email)->first();
            $user_id = optional($user)->id ?: 1;
            $store = [
                'user_id' => $user_id,
                'plan_name' => $data->plan_name ?? '',
                'status' => $paymentIntent->status . ' plan Updated',
                'duration' => $paymentIntent->duration ?? '',
                'price' => $paymentIntent->amount_paid / 100,
                'payment_intent' => $paymentIntent->payment_intent,
                'customer_id' => $paymentIntent->customer,
            ];

            Subscription::create($store);
            Log::info('Subscription created: ' . json_encode($store));

            return response('Webhook processed successfully.');
        } catch (\Exception $e) {
            Log::error('Error processing successful payment: ' . $e->getMessage());
            return response('Internal Server Error', 500);
        }
    }

    private function handleSubscriptionCancellation($subscription)
    {
        try {
            $customerId = $subscription->customer;
            $customer = Customer::retrieve($customerId);
            $user = User::where('email', $customer->email)->first();
            $user_id = optional($user)->id ?: 1;

            // Update the subscription ID dynamically based on the incoming webhook event
            $subscriptionId = $subscription->id;
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe::subscriptions()->update($subscriptionId, ['cancel_at_period_end' => true]);

            $store = [
                'user_id' => $user_id,
                'plan_name' => $subscription->items->data[0]->plan->nickname ?? '',
                'status' => $subscription->status . ' plan',
                'duration' => $subscription->items->data[0]->plan->interval_count ?? '',
                'price' => $subscription->items->data[0]->plan->amount / 100,
                'payment_intent' => $subscription->latest_invoice ?? '',
                'customer_id' => $subscription->customer,
            ];

            Subscription::create($store);

            return response('Subscription cancellation processed successfully.');
        } catch (\Exception $e) {
            Log::error('Error processing subscription cancellation: ' . $e->getMessage());
            return response('Internal Server Error', 500);
        }
    }

}
