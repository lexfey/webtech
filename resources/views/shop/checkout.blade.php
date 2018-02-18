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
    <link href="{{ asset('css/checkout.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

       <div class="container">
           <h2 class="title">Checkout</h2>
           <div class="panel-body">
               <div class="innerform">
                   <div class="checkItem">
                       <h3>Your Total: {{$total}}€ </h3>
                   </div>
                   <div class="checkItem">
                       {!! Form::open(['action' => 'ProductController@postCheckout', 'method'=> 'POST']) !!}
                       <h3>Adress Infos</h3>
                            <div class="Adress">
                               <div class="form-group">
                                   <label class="label">Full Name: </label>
                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                   @endif
                                   <input type="text" class="form-control" name="name" value="">
                               </div>
                               <div class="form-group">
                                   <label class="label">Street, number: </label>
                                   @if ($errors->has('street'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                   @endif
                                   <input type="text" class="form-control" name="street" value="">
                               </div>
                               <div class="form-group">
                                   <label class="label"> Zip-Code, City: </label>
                                   @if ($errors->has('city'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                   @endif
                                   <input type="text" class="form-control" name="city" value="">
                               </div>
                               <div class="form-group">
                                   <label class="label">Country: </label>
                                   @if ($errors->has('country'))
                                       <span class="help-block">
                                         <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                   @endif
                                   <input type="text" class="form-control" name="country" value="">
                               </div>
                            </div>
                   </div>
                   <div class="checkItem">
                       <h3>Payment Details</h3>
                       <div class="form-group">
                           <label class="label">What ever is needed </label>
                           <input type="text" class="form-control" name="pay" value="">
                       </div>
                   </div>
                   <div class="checkItem">
                       {{Form::submit('Buy Now', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
                       {!! Form::close() !!}
                   </div>
                   <a  href="https://www.paypal.com/us/webapps/mpp/pay-online" class="info linkIc2" target="_blank">
                       <i class="fab fa-paypal"></i> PayPal Info
                   </a>
                </div>
            </div>
       </div>
@endsection

