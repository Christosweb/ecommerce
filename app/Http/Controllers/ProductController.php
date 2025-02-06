<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{

  public function index(Request $request)
  {
    if (!$request->session()->has('user_session')) {
      $session_id = Str::uuid();
      // Cookie::queue('cookie_id',$cookie_id);
      session(['user_session' => $session_id], 60 * 24 * 30);
    }

    $products = Product::simplePaginate(6);
    return view('product.index', ['products' => $products]);
  }
  public function getSlug($slug)
  {
    $products = Product::where('slug', $slug)->paginate(15);

    return view('shirt', ['products' => $products]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //validate the request

    Product::create();
    $data = [
      'status' => 'product created successfully.',
    ];
    return response()->json($data, 200);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $product = Product::firstOrFail($id);
    $data = [
      'status' => 'success',
      'product' => $product
    ];
    return response()->json($data, 200);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    return view('edit');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    Product::where('id', $id)->update();
    $data = [
      'status' => 'product created successfully.',
    ];
    return response()->json($data, 200);

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Product::destroy($id);
    $data = [
      'status' => 'product deleted successfully.',
    ];
    return response()->json($data, 200);
  }

  public function success(Request $request)
  {
    if(!Auth::user()){
      Cart::where('session_id', session('user_session'))->delete();
      return view('product.success', ['orders' => false]);
    }

    $sessionID = $request->get('session_id');

    if ($sessionID === null) {
      return;
    }

    $session = Cashier::stripe()->checkout->sessions->retrieve($sessionID);

    if ($session->payment_status !== 'paid') {
      return;
    }

    $orderID = $session['metadata']['order_id'] ?? null;
    
   // $order = Order::findOrFail($orderID);
    $order = Order::where('session_id', $orderID)
                  ->where('status', 'incomplete')
                  ->where('order_identification', cache('order_identifier'))
                  ->update(['status' => 'completed']);

      //delete the cart items
      if($order){
      //remember to add user id to cart;
      // i think session is enough since it is used to identify and link user
         Cart::where('session_id', session('user_session'))->delete();
      }

    /*
    retrieve order base on cache, order identification
    this will return latest orders
    */
    $orders = Order::where('order_identification', cache('order_identifier'))
                   ->where('status', 'completed')
                   ->get();

    return view('product.success', ['orders' => $orders]);
  }
  public function cancel()
  {
    return view('product.cancel');
  }

  public function orderHistory(){
    $orderHistory = Order::where('user_id', Auth::user()->id)->get();
    // return $orderHistory;
     return view('product.order', ['orderHistory'=>$orderHistory]);
  }
}
