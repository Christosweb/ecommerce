<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;
use Illuminate\Support\Facades\Auth;

class paymentController extends Controller
{

    public function stripeCheckout(Request $request)
    {

        if (Auth::user()) {
            $requests = json_decode($request->getContent());
            $priceID = $requests->price_id;
            $quantity = $requests->quantity;
            $productID = $requests->productID;
            $price = $requests->price;
            $line_items = [$priceID => $quantity];

            $orderIdentifier = Str::uuid();
            cache(['order_identifier' => $orderIdentifier]);

            //populate order
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'product_id' => $productID,
                'price' => $price / $quantity,
                'quantity' => $quantity,
                'status' => 'incomplete',
                'total_amount' => $price,
                'session_id' => session('user_session'),
                'order_identification' => cache('order_identifier'),
            ]);

            $checkout = $request->user()->checkout($line_items, [
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('products'),
                'metadata' => ['order_id' => session('user_session')],
            ]);
            return response()->json(['redirect_url' => $checkout->url], 200);
        }

        $request = json_decode($request->getContent());
        $price = $request->price_id;
        $quantity = $request->quantity;
        $line_items = [$price => $quantity];

        //    return $line_items;
        $checkout = Checkout::guest()->create($line_items, [
            'success_url' => route('success'),
            'cancel_url' => route('products'),
        ]);
        return response()->json(['redirect_url' => $checkout->url], 200);
    }

    public function cartStripeCheckout(Request $request)
    {

        if (!Auth::user()) {
            try {
                $carts = Cart::select(['stripe_price_id', 'quantity'])->get();
                $line_items = [];

                foreach ($carts as $cart) {
                    $line_items[$cart->stripe_price_id] = $cart->quantity;
                }
                ;

                $checkout = Checkout::guest()->create($line_items, [
                    'success_url' => route('success'),
                    'cancel_url' => route('products'),
                ]);
                return response()->json(['redirect_url' => $checkout->url], 200);
            } catch (Exception $e) {
                return $e->getMessage();
            }
            ;
        }



        try {

            $carts = Cart::select(['stripe_price_id', 'quantity', 'price', 'stripe_product_id'])->get();
            $line_items = [];

            foreach ($carts as $cart) {
                $line_items[$cart->stripe_price_id] = $cart->quantity;
            }
            ;

            $orderIdentifier = Str::uuid();
            cache(['order_identifier' => $orderIdentifier]);

            //add all the product to order
            foreach ($carts as $item) {
                $orders = Order::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $item->stripe_product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'status' => 'incomplete',
                    'total_amount' => $item->price * $item->quantity,
                    'session_id' => session('user_session'),
                    'order_identification' => cache('order_identifier'),
                ]);
            }

            

            $checkout = $request->user()->checkout($line_items, [
                'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'),
                'metadata' => ['order_id' => session('user_session')],
            ]);
            return response()->json(['redirect_url' => $checkout->url], 200);


        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
}

