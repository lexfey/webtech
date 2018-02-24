@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<div class="container">
    <h2 class="titel">Login</h2>
    <div class="panel-body">
        @if(session('status'))
            <p class="infoStatus" >{{session('status')}}<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span></p>
        @endif()
        <form class="form-hoizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="innerform">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    @if ($errors->has('email'))
                        <input id="email" style="background-color: #f44336 " type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    @else
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    @if ($errors->has('password'))
                        <input id="password" style="background-color: #f44336 " type="password" class="form-control" name="password" required>
                    @else
                        <input id="password"  type="password" class="form-control" name="password" required>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" id="submitButton">
                        Login
                    </button>

                    <a id="Button" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    <p>No account yet? <a href="{{route('register')}}">Register Now!</a></p>
                </div>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection
