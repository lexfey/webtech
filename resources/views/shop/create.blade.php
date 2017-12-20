

@extends('layouts.app2')

@section('content')
<div class="registerbox">
<h2>Editing the ProductDatabase for Admin</h2>
{!! Form::open(['action' => 'ProductController@store', 'method'=> 'POST']) !!}

	<div class="editProduct">

	</div>
	{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}

{!! Form::close() !!}