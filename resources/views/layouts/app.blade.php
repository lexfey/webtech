<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Webtech Online Shop') }}</title>

    <!-- Styles -->
    <!---->
    <link href="{{asset('css/layout.css') }}" media="all" rel="stylesheet" type="text/css" />
    @yield('stylesheet')
       
    <!--Script-->    
    <script type="text/javascript" src="{{ asset('js/productslide.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/overlayer.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>


<body onload="showSlides(1)">
    <div id="app">
        @include ('inc.header')
        @include('inc.navbar')
        @include ('inc/messages')

        @yield('content')

        @include ('inc/footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!--Texteditorbar to use for text areas ..by giving id="article-ckeditor"-->
        <script>
            CKEDITOR.replace('article-ckeditor');
        </script>
</body>
</html>
