<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
?>

@extends('layouts.app')
@section('stylesheet')
	<link href="{{ asset('css/form.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="registerbox">
<h2>Editing the ProductDatabase for Admin</h2>
{!! Form::open(['action' => ['ProductController@update', $product->id], 'method'=> 'POST', 'enctype' => 'multipart/form-data']) !!}

	<div class="editProduct">
		<div class="form-group">
		{{Form::label('name', 'Product Name')}}
	   	{{Form::text('name', $product->name, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('price', 'Product Price')}}
	   	{{Form::text('price', $product->price, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('descr', 'Product Description')}}
	   	{{Form::textarea('descr', $product->descr, ['class' => 'form-control', 'placeholder' => 'Enter Product description', 'id' => 'article-ckeditor'])}}
	</div>
	<div class="form-group">
		{{Form::label('size', 'Product Size')}}
	   	{{Form::text('size', $product->size, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('color', 'Product Color')}}
	   	{{Form::text('color', $product->color, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('status', 'Product Status')}}
	   	{{Form::text('status', $product->status, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('image', 'Uploade new Image to replace')}}
	   	{{Form::file('image')}}
	</div>
	<div class="form-group">
		{{Form::label('image2', 'Uploade new Image2 to replace')}}
		{{Form::file('image2')}}
	</div>
	<div class="form-group">
		{{Form::label('image3', 'Uploade new Image3 to replace')}}
		{{Form::file('image3')}}
	</div>

	</div>
{{Form::hidden('_method', 'PUT')}} 
{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
{!! Form::close() !!}

<!--For deleting a product-->
{!! Form::open(['action' => ['ProductController@destroy', $product->id], 'method'=> 'POST']) !!}
	{{Form::hidden('_method', 'DELETE')}}
	{{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
{!!Form::close()!!}
</div>
@endsection