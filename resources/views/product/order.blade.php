<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order history</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

  <h3 class="text-center p-5">Order History</h3>
    <div class="overflow-x-auto">
  <table class="table table-zebra border border-solid" >
    <!-- head -->
    <thead class="bg-black text-white">
      <tr>
        <th>id</th>
        <th>order identification</th>
        <th>price</th>
        <th>quantity</th>
        <th>total</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      @foreach ( $orderHistory as $order )
      <tr class="">
      <th class="text-white {{$order->status=="completed"?"bg-success":'bg-red-600' }}">{{$order->id}}</th>
        <th class="text-white {{$order->status=="completed"?"bg-success":'bg-red-600' }}">{{$order->order_identification}}</th>
        <th class="text-white {{$order->status=="completed"?"bg-success":'bg-red-600' }}">{{$order->price}}</th>
        <th class="text-white {{$order->status=="completed"?"bg-success":'bg-red-600' }}">{{$order->quantity}}</th>
        <th class="text-white {{$order->status=="completed"?"bg-success":'bg-red-600' }}">{{$order->total_amount}}</th>
        <th class="text-white {{$order->status=="completed"?"bg-success":'bg-red-600' }}">{{$order->status}}</th>
      </tr>
       @endforeach
    </tbody>
  </table>
</div>
</body>
</html>
