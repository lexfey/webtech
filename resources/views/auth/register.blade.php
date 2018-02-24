@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<div class="container">
    <h2 class="title">Register</h2>
    <div class="panel-body">
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="innerform">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Username</label>
                    <div class="col-md-6">

                        @if ($errors->has('name'))
                            <input id="name" style="background-color: #f44336 " type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @else
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                    <div class="col-md-6">
                        @if ($errors->has('email'))
                            <input id="email" style="background-color: #f44336 " type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @else
                            <input id="email"  type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">

                        @if ($errors->has('password'))
                            <input id="password" style="background-color: #f44336 " type="password" class="form-control" name="password" required>
                        @else
                            <input id="password" type="password" class="form-control" name="password" required>

                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" id="submitButton">
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
