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

@endsection
@section('content')

<div class="container">
	<h2 class="title">Editing the Product for Admin</h2>
	<div class="panel-body">
		{!! Form::open(['action' => ['ProductController@update', $product->id], 'method'=> 'POST', 'enctype' => 'multipart/form-data']) !!}
		<div class="innerform">
			<div class="form-group">
			{{Form::label('name', 'Product Name')}}
				<div class="col-md-6">
			{{Form::text('name', $product->name, ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('price', 'Product Price')}}
				<div class="col-md-6">
				{{Form::text('price', $product->price, ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('descr', 'Product Description')}}
				<div class="col-md-6">
				{{Form::textarea('descr', $product->descr, ['class' => 'form-control', 'placeholder' => 'Enter Product description', 'id' => 'article-ckeditor'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('size', 'Product Size')}}
				<div class="col-md-6">
					{{Form::select('size', ['small'=>'Small', 'medium'=>'Medium', 'large'=>'Large'], $product->size, ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('color', 'Product Color')}}
				<div class="col-md-6">
				{{Form::text('color', $product->color, ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('status', 'Product Status')}}
				<div class="col-md-6">
					{{Form::select('status', ['av'=>'Available', 'cs'=>'Coming soon', 'out'=>'Sold out'], null, ['class' => 'form-control'])}}
				</div>
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
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
		{!! Form::close() !!}

		<!--For deleting a product-->
		{!! Form::open(['action' => ['ProductController@destroy', $product->id], 'method'=> 'POST']) !!}
			{{Form::hidden('_method', 'DELETE')}}
			{{Form::submit('Delete', ['id'=>'Button'])}}
		{!!Form::close()!!}
		</div>
	</div>
</div>
@endsection