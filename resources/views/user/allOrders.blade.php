<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 21.02.2018
 * Time: 15:04
 */
?>
@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/orders.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="container">
        <h2 class="titel">All Orders</h2>
        <div class="orders">
        @foreach($orders as $order)
                <div class="panel-body">
                    <form action="#">
                        <p>Order: {{$order->id}}</p>
                        <div class="date line">Ordered on the {{$order->created_at}}</div>
                            <span>
                                {{Form::label('status', 'Status:')}}
                                <div class="col-md-6">
                                    {{Form::text('status', $order->status, ['class' => 'orderInfo'])}}
                                </div>
                            </span>
                            <span>
                                {{Form::label('shippingID', 'Shipping ID:')}}
                                <div class="col-md-6">
                                    {{Form::text('shippingID', $order->shipping_Id, ['class' => 'orderInfo'])}}
                                </div>
                            </span>

                        <br>
                        <div class="box">
                            <p class="boxTitel">Order Details</p>
                            <ul class="orders">
                                @foreach($order->cart->items as $item)
                                    <li class="order">
                                        <span class="badge">{{$item['qty']}}x {{$item['item']['name']}}
                                            <span class="info">(id:{{$item['item']['id']}})</span>
                                            | sizes: {{$item['sizes']}}
                                            | color: {{$item['item']['color']}}
                                            | {{$item['price']}}€
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                            <div>
                                <p>Payment: {{$order->payment}}</p>
                                <strong class="price">Total Price: {{$order->cart->totalPrice}}€</strong>
                            </div>
                        </div>
                        <br>
                        <div class="box">
                            <p class="boxTitel">Shipping Adress</p>
                            <div class="adress">
                                <p class="line">{{$order->name}}</p>
                                <p class="line">{{$order->straße}}</p>
                                <p class="line">{{$order->city}}</p>
                                <p class="line">{{$order->country}}</p>
                            </div>
                            <p>Email:  | UserID: {{$order->user_id}}</p>
                        </div>

                        <input type="submit" value="Save Changes" id="submitButton">
                    </form>
                </div>

            @endforeach
        </div>
    </div>

@endsection
