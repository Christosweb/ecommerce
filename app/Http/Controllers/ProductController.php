<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
      if(!$request->session()->has('user_session')){
        $session_id = Str::uuid();
        // Cookie::queue('cookie_id',$cookie_id);
        session(['user_session' => $session_id]);
      }

      $products =  Product::paginate(15);
      return view('product.index', ['products'=>$products]);
    }
    public function getSlug($slug)
    {
      $products =  Product::where('slug', $slug)->paginate(15);
      
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
            'status'=>'product created successfully.',
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
            'status'=>'success',
            'product'=>$product
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
            'status'=>'product created successfully.',
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
            'status'=>'product deleted successfully.',
          ];
        return response()->json($data, 200);
    }

    public function success(){
      return view('product.success');
    }
    public function cancel(){
      return view('product.cancel');
    }
}
