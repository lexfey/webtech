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
                    {!! Form::open(['action' => 'ProductController@finalCheckout', 'method'=> 'POST']) !!}
                    <h3>Adress Details</h3>
                    <div class="Adress">
                        <div class="form-group">
                            <label class="label">Full Name: </label>
                            <input type="text" class="form-control" name="name" readonly value={{$name}} >
                        </div>
                        <div class="form-group">
                            <label class="label">Street, number: </label>

                            <input type="text" class="form-control" name="street" readonly value={{$street}}>
                        </div>
                        <div class="form-group">
                            <label class="label"> Zip-Code, City: </label>

                            <input type="text" class="form-control" name="city" readonly value={{$city}}>
                        </div>
                        <div class="form-group">
                            <label class="label">Country: </label>

                            <input type="text" class="form-control" name="country" readonly value={{$country}}>
                        </div>

                        <div class="form-group">
                            <label class="label">Payment: </label>

                            <input type="text" class="form-control" name="payment" readonly value={{$payment}}>
                        </div>

                    </div>
                </div>

                <div class="checkItem">
                    {{Form::submit('Submit Your Order', ['class'=>'btn btn-primary',  'id'=>'submitButton'])}}
                    {!! Form::close() !!}
                </div>

                <div href="{{ URL::previous() }}">Back</div>
                <br>

                <a  href="https://www.paypal.com/us/webapps/mpp/pay-online" class="info linkIc2" target="_blank">
                    <i class="fab fa-paypal"></i> PayPal Info
                </a>
            </div>
        </div>
    </div>
@endsection

