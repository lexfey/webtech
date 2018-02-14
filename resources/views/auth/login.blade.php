@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<div class="container">
    <h2 class="titel">Login</h2>
    <div class="panel-body">
        @if(session('status'))
            {{session('status')}}
        @endif()
        <form class="form-hoizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="innerform">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
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
