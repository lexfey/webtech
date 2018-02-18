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
             <a class="btn" href="{{ route('account')}}" >
                 <div class="column btn_column">
                     <p class="btn_title"><i class="fas fa-lock"></i> Long In and Safety</p>
                     <p class="btn_description">Edit Logindata, Name and Number</p>
                 </div>
             </a>
             <a class="btn" href="{{ route('orders')}}">
                 <div class="column  btn_column">
                     <p class="btn_title"><i class="fas fa-truck"></i> Orders</p>
                     <p class="btn_description">See the status of your Orders</p>
                 </div>
             </a>
             <a class="btn" href="#">
                 <div class="column  btn_column">
                     <p class="btn_title"><i class="fab fa-paypal"></i> Payment Details</p>
                     <p class="btn_description">bla bla bla</p>
                 </div>
             </a>
             <a class="btn" href="#">
                 <div class="column  btn_column">
                     <p class="btn_title"><i class="fas fa-map-marker"></i> Adress</p>
                     <p class="btn_description">bla bla bla</p>
                 </div>
             </a>
        </div>
    </div>
@endsection