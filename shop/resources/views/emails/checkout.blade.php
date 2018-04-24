<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .products-container {
            margin-top: 20px;
        }
    </style>
    <title>Checkout</title>
</head>
<body>
    <ul>
        <li>Name: {{$name}}</li>
        <li>Contact Details: {{$contactDetails}}</li>
        <li>Comments: {{$comments}}</li>
    </ul>
    <span>Products:</span>
   <ul>
       @foreach($cart as $key => $item)
           @if($key !== 'total')
               <div class="products-container">
                   <li>Title: {{$item['product']['title']}}</li>
                   <li>Description: {{$item['product']['description']}}</li>
                   <li>Quantity: {{$item['quantity']}}</li>
                   <li>Price: {{$item['product']['price'] * $item['quantity']}}$</li>
               </div>
            @endif
           @endforeach
       <span>Total: {{$cart['total']}}$</span>
   </ul>
</body>
</html>
