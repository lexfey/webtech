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
                    <p>mehr Infos zur bestellung</p>
                    <h3>Your Total: {{$total}}€ </h3>
                </div>
                <div class="checkItem">
                    {!! Form::open(['action' => 'ProductController@finalCheckout', 'method'=> 'POST']) !!}
                    <h3>Adress Details</h3>
                    <div class="Adress">
                        <div class="form-group">
                            <label class="label">First Name: </label>
                            <input type="text" class="form-control" name="name1" readonly value={{$name1}} >
                        </div>
                        <div class="form-group">
                            <label class="label">Last Name </label>
                            <input type="text" class="form-control" name="name2" readonly value={{$name2}}>
                        </div>
                        <div class="form-group">
                            <label class="label">Street </label>
                            <input type="text" class="form-control" name="street" readonly value={{$street}}>
                        </div>
                        <div class="form-group">
                            <label class="label">Number </label>
                            <input type="number" class="form-control" name="number" readonly value={{$number}}>
                        </div>
                        <div class="form-group">
                            <label class="label">City: </label>
                            <input type="text" class="form-control" name="city" readonly value={{$city}}>
                        </div>
                        <div class="form-group">
                            <label class="label">Zip: </label>
                            <input type="number" class="form-control" name="zip" readonly value={{$zip}}>
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
                <a id="Button" href="{{ URL::previous() }}">Back</a>
            </div>
        </div>
    </div>
@endsection

