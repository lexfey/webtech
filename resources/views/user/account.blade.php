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
    <link href="{{ asset('css/login.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="registerbox">
        <h2>Change Password</h2>
        <h5>not working because password comparing ...</h5>
        {!! Form::open(['action' => ['UserController@update', Auth::user()->id], 'method'=> 'POST']) !!}

        <div class="editProduct">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="oldpassword" class="col-md-4 control-label">Old Password</label>
                <div class="col-md-6">
                    <input id="oldpassword" type="password" class="form-control" name="password" required>
                    {{Auth::user()->password}}
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
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
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
        {!! Form::close() !!}

    </div>


@endsection
