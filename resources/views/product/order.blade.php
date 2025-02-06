<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order history</title>
</head>
<body>

    <div class="overflow-x-auto">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
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
      <tr>
      <th>{{$order->id}}</th>
        <th>{{$order->order_identification}}</th>
        <th>{{$order->price}}</th>
        <th>{{$order->quantity}}</th>
        <th>{{$order->total_amount}}</th>
        <th>{{$order->status}}</th>
      </tr>
       @endforeach
    </tbody>
  </table>
</div>
</body>
</html>
