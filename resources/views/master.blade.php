<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Maquetación</title>

        @include("styles")
    </head>

    <body>
        <div class="main">
        @yield('content')
        </div>
    </body>
</html>