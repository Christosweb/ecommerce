<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    payment successful.
    @if ($orders)

    @foreach ($orders as $order)
      {{ $order }}
    @endforeach
    
    @endif

    {{ 'you are a guest user' }}
</body>
</html>