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
                       {!! Form::open(['action' => 'ProductController@postCheckout', 'method'=> 'POST']) !!}
                       <!--todo! input wird bei white space gecutet-->
                       <h3>Adress Details</h3>
                            <div class="Adress">
                               <div class="form-group">
                                   <span>
                                   <label class="label">First Name: </label>
                                   @if ($errors->has('name'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('name1') }}</strong>
                                        </span>
                                   @endif
                                   <input type="text" class="form-control" name="name1" value="">
                                   </span>
                                   <span>
                                       <label class="label">Last Name: </label>
                                       @if ($errors->has('name'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('name2')}}</strong>
                                        </span>
                                       @endif
                                       <input type="text" class="form-control" name="name2" value="">
                                   </span>
                               </div>
                               <div class="form-group">
                                   <label class="label">Street: </label>
                                   @if ($errors->has('street'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                   @endif
                                   <input type="text" class="form-control" name="street" value="">
                                   <span>
                                       <label class="label">Number: </label>
                                       @if ($errors->has('number'))
                                           <span class="help-block">
                                            <strong>{{ $errors->first('number')}}</strong>
                                        </span>
                                       @endif
                                       <input type="number" class="form-control" name="number" value="">
                                   </span>
                               </div>
                               <div class="form-group">
                                   <span>
                                       <label class="label">Zip: </label>
                                       @if ($errors->has('zip'))
                                           <span class="help-block">
                                            <strong>{{ $errors->first('zip')}}</strong>
                                        </span>
                                       @endif
                                       <input type="number" class="form-control" name="zip" value="">
                                   </span>
                                   <label class="label">City: </label>
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
                       <h3>Payment Method</h3>
                       <div class="form-group">
                           <p>{{ Form::radio('payment', 'prepayment') }} Prepayment (order will be process after we've received your payment)</p>
                           <p>{{ Form::radio('payment', 'invoice')}} Invoice</p>

                       </div>
                   </div>
                   <div class="checkItem">
                       {{Form::submit('Review Your Order', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
                       {!! Form::close() !!}
                   </div>

                   <div href="{{ URL::previous() }}">Back</div>
<br>
                   <div  href="https://www.paypal.com/us/webapps/mpp/pay-online" class="info linkIc2" target="_blank">
                       <i class="fab fa-paypal"></i> PayPal Info
                   </div>
                </div>
            </div>
       </div>
@endsection

