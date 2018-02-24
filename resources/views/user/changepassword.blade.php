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
        <h2 class="titel">Change Password</h2>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('changepassword') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">

                                    @if ($errors->has('current-password'))
                                        <input id="current-password" style="background-color: #f44336 " type="password" class="form-control"
                                               name="current-password" required>
                                    @else
                                        <input id="current-password"  type="password" class="form-control"
                                               name="current-password" required>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    @if ($errors->has('new-password'))
                                        <input id="new-password" style="background-color: #f44336 "  type="password" class="form-control" name="new-password"
                                               required>
                                    @else
                                        <input id="new-password" type="password" class="form-control" name="new-password"
                                               required>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New
                                    Password</label>

                                <div class="col-md-6">
                                    @if ($errors->has('new-password-confirm'))
                                        <input id="new-password-confirm" style="background-color: #f44336 "  type="password" class="form-control" name="new-password"
                                               required>
                                    @else
                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password"
                                               required>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" id="submitButton">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection