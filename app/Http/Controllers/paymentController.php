<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;

class paymentController extends Controller
{
    public function stripeCheckout(Request $request){

        $request = json_decode($request->getContent());
        $price = $request->price_id;
        $quantity = $request->quantity;
        $line_items = [$price => $quantity];
    //    return $line_items;
        $checkout = Checkout::guest()->create( $line_items, [
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        return response()->json(['redirect_url' => $checkout->url], 200);
    }

    public function cartStripeCheckout(){

        
        try{
            $carts = Cart::select(['stripe_price_id', 'quantity'])->get();
            $line_items = [];
   
            foreach($carts as $cart){
               $line_items[$cart->stripe_price_id] = $cart->quantity ;
            };

         $checkout = Checkout::guest()->create( $line_items, [
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);
        return response()->json(['redirect_url' => $checkout->url], 200);
        }catch(Exception $e){
                return $e->getMessage();
        };
        
    }
}

