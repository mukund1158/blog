<?php 
use Illuminate\Support\Facades\App;

App::setlocale($details['user']['lang']);
?>

<!DOCTYPE html>
<html lang="{{ $details['user']['lang'] }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

  <h1>{{$details['title']}}</h1>

  

   <h2>{{ __('card.Hi') }} {{ $details['user']['name'] }}, {{ __('card.Your Profile has been updated at') }} {{ $details['user']['updated_at'] }}. </h2>
    
   <h2>{{ __('card.welcome to') }} Laravel</h2>
   

   

</body>
</html>


