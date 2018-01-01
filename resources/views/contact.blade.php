@extends('layouts.app')


@section('content')
	@if(!Auth::guest()){
		<!--@if(Auth::user()->id == $post->user_id) @endif-->
		<p>Hey! We have your Email somewhere..</p>
	}
	@endif
	<h1>Contact</h1>
	{!! Form::open(['url' => 'contact/submit']) !!}
		<div class="form-group">
	   	{{Form::label('name', 'Name')}}
	   	{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter name'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('email', 'E-Mail Address')}}
	   	{{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter Email'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('message', 'Message')}}
	   	{{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Enter Message', 'id' => 'article-ckeditor'])}}
	   </div>
	   <div>
	   	{{Form::submit('Submit', ['class'=>'btn btn-primary', 'id'=>'submitButton'])}}
	   </div>
	{!! Form::close() !!}
@endsection