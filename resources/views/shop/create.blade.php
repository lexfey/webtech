

@extends('layouts.app')

@section('content')
<div class="registerbox">
<h2>Adding to the ProductDatabase for Admin</h2>
{!! Form::open(['action' => 'ProductController@store', 'method'=> 'POST', 'enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
		{{Form::label('name', 'Product Name')}}
	   	{{Form::text('name', '', ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('price', 'Product Price')}}
	   	{{Form::text('price', '', ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('descr', 'Product Description')}}
	   	{{Form::textarea('descr', '', ['class' => 'form-control', 'placeholder' => 'Enter Product description', 'id' => 'article-ckeditor'])}}
	</div>
	<div class="form-group">
		{{Form::label('size', 'Product Size')}}
	   	{{Form::text('size', '', ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('color', 'Product Color')}}
	   	{{Form::text('color', '', ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('status', 'Product Status')}}
	   	{{Form::text('status', '', ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('image', 'Uploade Image')}}
	   	{{Form::file('image')}}
	</div>
	{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}

{!! Form::close() !!}
@endsection