<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrfToken">
    <title>Document</title>
    <script src="{{asset('scripts/main.js')}}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
     <!-- modal start -->
     @include('includes.modal_inc')
      <!-- modal end -->
    <!-- main starts-->
    <main class='bg-gray-600 py-10 cart-container'>
        <div class='flex flex-row flex-wrap gap-5 justify-center product-container'>
            @foreach ($carts as $cart)
            <div class="card bg-base-100 w-96  h-76 shadow-xl">
                <figure class="px-10 pt-10 bg-primary">
                    <img src={{ $cart->path }} alt="Shoes" class="rounded-xl path w-36 h-36" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title"> {{$cart->name}} </h2>
                    <p> $ <span class="price cart" data-price="{{$cart->price}}"  data-stripe_price_id="{{$cart->stripe_price_id}}">{{$cart->price}}</span> </p>
                    <div class="card-actions flex flex-col justify-center items-center">
                        <div class="counter">
                            <button class="btn btn-primary decreament">-</button>
                            <span class="quantity">1</span>
                            <button class="btn btn-primary increament">+</button>
                        </div>

                        <div class="flex gap-5">
                        <button class="btn btn-primary delete product_id" data-id="{{$cart->stripe_product_id}}" data-stripe_price_id="{{$cart->stripe_price_id}}">delete</button>
                        <button class="btn btn-primary buy" data-price="{{$cart->stripe_price_id}}">buy now</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
       <div class="total-container flex flex-col justify-center items-center mt-20 text-white">
        <div class="total flex ">
            <p>total:</p>
            <div>$ <span class="total-price">0.00</span></div>
        </div>

          <button class="proceed btn btn-primary w-96" type="button">proceed</button>
       </div>
    </main>
    <!-- main end -->
    @include('includes.footer_inc')
</body>
</html>
