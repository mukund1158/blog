<?php 
use Illuminate\Support\Facades\App;

App::setlocale($userLang);

?>

<!DOCTYPE html>
<html lang="{{ $userLang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

  <h1>{{ __('card.Hay') }}, {{ __('card.Happy Birthday') }} {{ $userName }}</h1>

  <h3>{{ __('Wish you many many Happy Return of the day......') }}</h3>
  <h3>{{ __('card.Happy Birthday') }} {{ $userName }}</h3>

</body>
</html>


