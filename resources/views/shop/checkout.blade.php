<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 08:44
 */
?>
@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/cart.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

       <div class="container">
           <h2 class="title">Checkout</h2>
           <h4>Your Total: {{$total}}€ </h4>
           <div class="panel-body">
           {!! Form::open(['action' => 'ProductController@postCheckout', 'method'=> 'POST']) !!}
              <div class="innerform">
               <div class="Adress">
                   <div class="form-group">
                       <p class="label">Full Name: </p>
                       <input type="text" class="form-control" name="name" value="">
                   </div>
                   <div class="form-group">
                       <p class="label">Street: </p>
                       <input type="text" class="form-control" name="street" value="">
                   </div>
                   <div class="form-group">
                       <p class="label">City: </p>
                       <input type="text" class="form-control" name="city" value="">
                   </div>
                   <div class="form-group">
                       <p class="label">Country: </p>
                       <input type="text" class="form-control" name="country" value="">
                   </div>
               </div>
           {{Form::submit('Buy', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
           {!! Form::close() !!}
           </div>
        </div>
       </div>
@endsection

