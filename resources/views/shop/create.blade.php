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
	<h2 class="titel">Adding to the ProductDatabase for Admin</h2>
	<div class="panel-body">
		{!! Form::open(['action' => 'ProductController@store', 'method'=> 'POST', 'enctype' => 'multipart/form-data']) !!}
			<div class="innerform">
			<div class="form-group">
				{{Form::label('name', 'Product Name')}}
				<div class="col-md-6">
					{{Form::text('name', '', ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('price', 'Product Price')}}
				<div class="col-md-6">
				{{Form::text('price', '', ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('descr', 'Product Description')}}
				<div class="col-md-6">
				{{Form::textarea('descr', '', ['class' => 'form-control', 'placeholder' => 'Enter Product description', 'id' => 'article-ckeditor'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('color', 'Product Color')}}
				<div class="col-md-6">
				{{Form::text('color', '', ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('sizeS', 'Quantity of S')}}
				<div class="col-md-6">
					{{Form::number('sizeS','', ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('sizeM', 'Quantity of M')}}
				<div class="col-md-6">
					{{Form::number('sizeM','', ['class' => 'form-control'])}}
				</div>
			</div>
			<div class="form-group">
				{{Form::label('sizeL', 'Quantity of L')}}
				<div class="col-md-6">
					{{Form::number('sizeL','', ['class' => 'form-control'])}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('image', 'Uploade Image')}}
				{{Form::file('image')}}
			</div>

			<div class="form-group">
				{{Form::label('image2', 'Uploade Image2')}}
				{{Form::file('image2')}}
			</div>
			<div class="form-group">
				{{Form::label('image3', 'Uploade Image3')}}
				{{Form::file('image3')}}
			</div>

			{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
			{!! Form::close() !!}

		</div>
	</div>
</div>
@endsection