<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet"  href="/css/app.css"> 
    <link href="{{ asset('css/all.css') }}" media="all" rel="stylesheet" type="text/css" />
       
    <!--Script-->    
    <script type="text/javascript" src="{{ asset('js/productslide.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/overlayer.js') }}"></script>
</head>
<body>
    <div id="app">
        @include ('inc.header')
        @include('inc.navbar')
        @include ('inc/messages')
        @yield('content')
        <div id="overlayer">
        @include('login')
        </div>  

        @include ('inc/footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
