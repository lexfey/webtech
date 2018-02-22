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
        <h2 class="title">Checkout - Confirm</h2>
        <div class="panel-body">
            <div class="innerform">
                <div class="checkItem">
                    <h3>Bestellungs Details</h3>
                    @foreach((array)$products as $product)
                        <li class="items">
                            <div class="infoWrap" >
                                <span><img class="itemImgSmall" src="{{asset('images/'.$product['item']['image'])}}" alt="{{$product['item']['name']}}"></span>
                            </div>
                            <div class="infoWrap right">
                                <h4>{{$product['item']['name']}}</h4>
                                <p>Size(s): {{$product['sizes']}} </p>
                                <p>Quantity: {{$product['qty']}}</p>
                                <p>Price: {{$product['price']}} € </p>
                            </div>
                        </li>
                    @endforeach
                    <div class="rightItem">
                    <p class="total">Your Total: {{$total}}€ * </p>
                    <p class="info">*Shipping cost included</p>
                    </div>
                </div>
                <div class="checkItem">
                    {!! Form::open(['action' => 'ProductController@finalCheckout', 'method'=> 'POST']) !!}
                    <h3>Adress Details</h3>
                    <div class="Adress">
                        <div class="form-group">
                            <span><input type="text" class="readForm" name="name1" readonly value={{$name1}}>
                            <input type="text" class="readForm" name="name2" readonly value={{$name2}}></span>
                        </div>
                        <div class="form-group">
                            <span><input type="text" class="readForm" name="street" readonly value={{$street}}></span>
                            <span><input type="number" class="readForm" name="number" readonly value={{$number}}></span>
                        </div>
                        <div class="form-group">
                            <span><input type="number" class="readForm" name="zip" readonly value={{$zip}}></span>
                            <span><input type="text" class="readForm" name="city" readonly value={{$city}}></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="readForm" name="country" readonly value={{$country}}>
                        </div>
                    </div>
                </div>
                <div class="checkItem">
                    <h3>Payment Details</h3>
                    <div class="Adress">
                        <div class="form-group">
                            <label class="label">Payment: </label>
                            <input type="text" class="readForm" name="payment" readonly value={{$payment}}>
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

