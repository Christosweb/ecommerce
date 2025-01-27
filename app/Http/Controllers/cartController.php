<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use Illuminate\Http\Request;

class cartController extends Controller
{
    
    public function create(Request $request){
        $request->validate([
             'name' => 'required',
             'price_id' => 'required',
             'price' => 'required',
             'path' => 'required',
             'product_id' => 'required',
        ]);

       try{
        $cart = Cart::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stripe_price_id' => $request->input('price_id'),
            'path' => $request->input('path'),
            'stripe_product_id' => $request->input('product_id'),
            'session_id'=> session('user_session'),
       ]);
       }catch(Exception $e){
        return $e->getMessage();
       }

        if($cart){
            $data = [
                'status'=>'success',
                'message'=>'cart added successfully',
                'numberOfCarts' => $this->getNumberOfAddedCart()
            ];
            return response()->json($data, 200);
            
        }
    }

    public function getNumberOfAddedCart(){
       return Cart::where('session_id', session('user_session'))->count('id');
    }

    public function show(){
     $carts = Cart::where('session_id', session('user_session'))->get();
        //    return $cart;
     return view('cart', ['carts'=>$carts]);
    }

    public function calculatePrices(){
       $sum =  Cart::where('session_id', session('user_session'))->sum('price');
       $data = [
        'status' => 'success',
        'message'=> $sum
       ];
       return response()->json($data, 200);
    }

    public function destroy($stripePriceID){
        Cart::where('session_id', session('user_session'))
       -> where('stripe_price_id', $stripePriceID)->delete();
        $data = [
            'status'=>'success',
            'message'=>'cart deleted successfully',
            'numberOfCarts' => $this->getNumberOfAddedCart()
        ];
        return response()->json($data, 200);
    }

    public function updateQuantity(Request $request){
           $request = json_decode($request->getContent());
           Cart::where('session_id', session('user_session'))
                -> where('stripe_price_id', $request->price_id)
                ->update(['quantity'=>$request->quantity]);
    }
}
