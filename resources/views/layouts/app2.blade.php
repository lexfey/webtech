<!DOCTYPE html>
<html>
	<head>
		<title>App</title>
		<!--<link rel="stylesheet"  href="/css/app.css"> -->
		<link href="{{ asset('css/all.css') }}" media="all" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="{{ asset('js/productslide.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/overlayer.js') }}"></script>
	</head>

		@if(Request::is('/product'))
		<body onload="showSlides(1)">
		@else
		<body>
		@endif

		@include ('inc/header')
		@include ('inc/navbar2')
		@include ('inc/messages')

		@yield('content')
		<div id="overlayer">
		@include('login')
		</div>	

		@include ('inc/footer')

		<!--Texteditorbar to use for text areas ..by giving id="article-ckeditor"-->
		<script>
			CKEDITOR.replace('article-ckeditor');
		</script>
	</body>
</html>