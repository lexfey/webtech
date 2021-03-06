<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
?>

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
    <link href="{{asset('css/layout.css') }}" media="all" rel="stylesheet" type="text/css" />
    @yield('stylesheet')
       
    <!--Script-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

</head>


<body onload="showSlides(1)">
    <div id="app">
        @include ('inc.header')
        @include('inc.navbar')
        @include ('inc/messages')
        <div class="content">
        @yield('content')
        </div>
        @include ('inc/footer')
    </div>
</body>
</html>
