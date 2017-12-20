@extends('layouts.app2')

@section('content')
<div class="registerbox">
<h1>Register</h1>
{!! Form::open(['action' => ['UserController@update', $user->$id],'method'=> 'POST']) !!}
		<div class="form-group">
	   	{{Form::label('firstname', 'First Name')}}
	   	{{Form::text('firstname', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('lastname', 'Last Name')}}
	   	{{Form::text('lastname', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('email', 'E-Mail Address')}}
	   	{{Form::text('email', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter Email'])}}
	   </div>
		<div class="form-group">
	   	{{Form::label('street', 'Street')}}
	   	{{Form::text('street', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter Street'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('zipcode', 'Zipcode')}}
	   	{{Form::text('zipcode', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter zipcode'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('city', 'City')}}
	   	{{Form::text('city', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter city'])}}
	   </div>
	   <div class="form-group">
	   	{{Form::label('country', 'Country')}}
	   	{{Form::text('country', $user->firstname, ['class' => 'form-control', 'placeholder' => 'Enter country'])}}
	   </div>

	  	<div class="form-group">
      	{{Form::label('password', 'Password')}}
      	{{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password'])}}
     	</div>
     	<div class="form-group">
      	{{Form::label('repPassword', 'Repeat Password')}}
      	{{Form::password('repPassword', ['class' => 'form-control'])}}
    	 </div>
	   <div>
	   	{{Form::hidden('_method', 'PUT')}} <!--Put request needed to make update-->
	   	{{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
	   </div>
{!! Form::close() !!}
</div>
@endsection