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
                       <h3>Adress Details</h3>
                            <div class="Adress">
                               <div class="form-group">
                                   <span>
                                   <label class="label">First Name: </label>
                                   @if ($errors->has('name'))
                                           <input type="text" style="background-color: #f44336 " class="form-control" name="name1" value="">
                                   @else
                                           <input type="text" class="form-control" name="name1" value="">
                                   @endif
                                   </span>
                                   <span>
                                       <label class="label" >Last Name: </label>
                                       @if ($errors->has('name'))
                                           <input type="text" style="background-color: #f44336 " class="form-control" name="name2" value="">
                                       @else
                                           <input type="text" class="form-control" name="name2" value="">
                                       @endif
                                       </span>
                               </div>
                               <div class="form-group">
                                   <label class="label">Street: </label>
                                   @if ($errors->has('street'))
                                       <input type="text" style="background-color: #f44336 "  class="form-control" name="street" value="">
                                   @else
                                       <input type="text" class="form-control" name="street" value="">
                                   @endif

                                   <span>
                                       <label class="label">Number: </label>
                                       @if ($errors->has('number'))
                                           <input type="number" style="background-color: #f44336 "  class="form-control" name="number" value="">
                                       @else
                                           <input type="number" class="form-control" name="number" value="">
                                       @endif
                                        </span>
                               </div>
                               <div class="form-group">
                                   <span>
                                       <label class="label">Zip: </label>
                                       @if ($errors->has('zip'))
                                           <input type="number" style="background-color: #f44336 " class="form-control" name="zip" value="">
                                       @else
                                           <input type="number" class="form-control" name="zip" value="">
                                       @endif
                                      </span>
                                   <label class="label">City: </label>
                                   @if ($errors->has('city'))
                                       <input type="text" style="background-color: #f44336 " class="form-control" name="city" value="">
                                   @else
                                       <input type="text" class="form-control" name="city" value="">
                                   @endif

                               </div>
                               <div class="form-group">
                                   <label class="label">Country: </label>
                                   @if ($errors->has('country'))
                                       <input type="text" style="background-color: #f44336 " class="form-control" name="country" value="">
                                   @else
                                       <input type="text"  class="form-control" name="country" value="">
                                   @endif
                                   </div>
                            </div>
                   </div>
                   <div class="checkItem">
                       <h3>Payment Method</h3>
                       <div class="form-group">
                           <p>{{ Form::radio('payment', 'invoice', true)}} Invoice</p>
                       </div>
                       <br>
                       <a  href=# class="info" target="_blank">
                           <i class="fas fa-info-circle"></i> Right now you can only pay on Invoice
                       </a>
                   </div>
                   <div class="checkItem">
                       {{Form::submit('Review Your Order', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
                       {!! Form::close() !!}

                       <a id="Button" href="{{ URL::previous() }}">Back</a>
                   </div>
                </div>
            </div>
       </div>
@endsection

