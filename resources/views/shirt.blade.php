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

<body class='bg-red-600'>
    <header>
       <nav class="bg-primary p-5 nav">
           @include('includes.navbar_inc') 
      </nav>
    </header>
     <!-- modal start -->
     @include('includes.modal_inc')
      <!-- modal end -->
    <!-- main starts-->
    <main class='bg-gray-600 py-10'>
        <div class='flex flex-row flex-wrap gap-5 justify-center product-container'>
            @foreach ($products as $product)
            <div class="card bg-base-100 w-96 h-76 shadow-xl">
                <figure class="px-10 pt-10 bg-primary">
                    <img src={{ asset('images/'.$product->path) }} alt="Shoes" class="rounded-xl path w-36 h-36 src" />
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title product-name"> {{$product->name}} </h2>
                    <p class="desc"> {{$product->description}} </p>
                    <p> $<span class="price" data-stripe_price_id="{{$product->stripe_price_id}}">{{$product->price}}</span> </p>
                    <div class="card-actions">
                    <span class="quantity hidden">1</span>
                        <button class="btn btn-primary buy">Buy Now</button>
                        <button class="btn btn-primary cart-btn" data-id="{{$product->id}}">Add To Cart</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </main>
    <!-- main end -->

    @include('includes.footer_inc')
</body>

</html>
