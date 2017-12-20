

<div id="login_box">
   <img class="turnOff_btn" onclick="off()" src="img/x.png"> 
     <!--<span style="color:green">' .$infoMsg.'</span>-->
	 <h2>Login</h2>
   @include('inc.messages')
	{!! Form::open(['url' => '/']) !!}
     <div class="form-group">
      {{Form::label('email', 'E-Mail')}}
      {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter Email', 'id'=>'email'])}}
     </div>
     <div class="form-group">
      {{Form::label('password', 'Password')}}
      {{Form::password('password', ['class' => 'form-control', 'id'=>'password'])}}
     </div>
     <a href="#" id="pwforgot"> Forgot password?</a>
     <div>
      {{Form::submit('Submit', ['class'=>'btn btn-primary', 'id'=>'submitButton'])}}
     </div>
  {!! Form::close() !!}
	<a class="reg_link" href="register2">Register here</a>
	<!--<span style="color:orange">' .$warningMsg.'</span>-->
</div>
  

 