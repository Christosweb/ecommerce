<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-grey-600 text-white">
    <div class="text-center text-lg bg-info">  
      <p> your order has been placed successfully.</p>
    </div>

    @if ($orders)

    <div class="text-lg">
      <h1 class=""> products order </h1>
    @foreach ($orders as $order)
       <div class="">
        <ul>
          <li>price: {{$order->price}}</li>
          <li>quantity: {{$order->quantity}}</li>
          <li>total amount: {{$order->total_amount}}</li>
          <li>status: {{$order->status}}</li>
          <li>order-id: {{$order->order_identification}}</li>
        </ul>
       </div>
    @endforeach
  </div>
    
    @endif

    
</body>
</html>