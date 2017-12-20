

@extends('layouts.app2')

@section('content')
<div class="registerbox">
<h2>Editing the ProductDatabase for Admin</h2>
{!! Form::open(['action' => 'ProductController@update', 'method'=> 'POST']) !!}

	<div class="editProduct">

	</div>
{{Form::hidden('_method', 'PUT')}} 
{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}

{!! Form::close() !!}

<!--For deleting a product-->
{!! Form::open(['action' => '[ProductController@destroy', $product->id] 'method'=> 'POST', class="pull right"]) !!}
	{{Form::hidden('_method', 'DELETE')}}
	{{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
{!!Form::close()!!}

@endsection