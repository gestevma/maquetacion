<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="">

        <title>Maquetación</title>

        @include("admin.desktop.layout.partials.styles")
    </head>

    <body>
        <div class="main">
             @yield('content')
        </div>

        @include("admin.desktop.layout.partials.js")
    </body>
</html>

