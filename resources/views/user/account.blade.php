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
    <link href="{{ asset('css/profile.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container">
    <h2 class="titel">Welcome {{ Auth::user()->name }}</h2>

    <div class="btn_box">
        <a class="btn" href="{{ route('changepassword')}}" >
            <div class="column btn_column">
                <p class="btn_title"><i class="fas fa-lock"></i> Change password</p>
                <p class="btn_description">Edit Logindata, Name and Number</p>
            </div>
        </a>
        <a class="btn" href="{{ route('deleteaccount')}}" >
            <div class="column btn_column">
                <p class="btn_title"><i class="fas fa-lock"></i> Delete account</p>
                <p class="btn_description">Delete your account</p>
            </div>
        </a>

    </div>
    </div>
@endsection