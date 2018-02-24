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
                    <form action="/changeOrder/{{$order->id}}">
                        <br>
                        <p class="boxTitel head"> Order: {{$order->id}} <span class="date line">Ordered on the {{$order->created_at}}</span></p>
                        <div class="box">
                            <span class="input">
                                {{Form::label('status', 'Status:')}}
                                {{Form::text('status', $order->status, ['class' => 'orderInfo'])}}
                            </span>
                            <span class="input">
                                {{Form::label('shippingID', 'Shipping ID:')}}
                                {{Form::text('shippingID', $order->shipping_Id, ['class' => 'orderInfo'])}}
                            </span>
                        </div>
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
                            <p class="price">Payment: {{$order->payment}}  -  Total Price: {{$order->cart->totalPrice}}€ </p>
                        </div>
                        <br>
                        <div class="box">
                            <p class="boxTitel">Shipping Adress</p>
                            <div class="adress">
                                <p class="line">{{$order->firstName}} {{$order->lastName}} </p>
                                <p class="line">{{$order->street}}, {{$order->number}}</p>
                                <p class="line"> {{$order->zip}} {{$order->city}}</p>
                                <p class="line">{{$order->country}}</p>
                            </div>
                            <p>Email: {{$order->email}} | UserID: {{$order->user_id}}</p>
                        </div>

                        <input type="submit" value="Save Changes" id="submitButton">
                    </form>
                </div>

            @endforeach
        </div>
    </div>

@endsection
