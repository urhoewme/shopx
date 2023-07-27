<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $id = \auth()->user()->id;
        $user = User::findOrFail($id);
        $cartItems = $user->cartOwner()->get();
        $lineItems = [];
        foreach ($cartItems as $cartItem) {
            $services = $cartItem->services;
            $servicePrice = 0;
            foreach ($services as $service) {
                $servicePrice += $service['price'];
            }
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $cartItem->product->title,
                    ],
                    'unit_amount_decimal' => ($cartItem->product->price + $servicePrice) * 100,
                ],
                'quantity' => $cartItem['quantity'],
            ];
        }
        $stripe = new \Stripe\StripeClient(getenv('STRIPE_SECRET_KEY'));
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_creation' => 'always',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.failure', [], true),
        ]);

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {

        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        try {
            $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
            if (!$session) {
                return view('checkout.failure');
            }
            $customer = \Stripe\Customer::retrieve($session->customer);
            return view('checkout.success', compact('customer'));
        } catch (\Exception $e) {
            return view('checkout.failure');
        }
    }

    public function failure(Request $request)
    {
        dd($request->all());
    }
}
