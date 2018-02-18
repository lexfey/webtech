<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 14.02.2018
 * Time: 17:09
 */
?>
@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/orders.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container">
        <h2 class="titel">My Orders</h2>
        @foreach($orders as $order)
        <div class="panel-body">
            <ul class="orders">
                @foreach($order->cart->items as $item)
                <li class="order">
                    <span class="badge">{{$item['price']}}€</span>
                    {{$item['item']['name']}} | {{$item['qty']}} Units
                </li>
                @endforeach
            </ul>
            <div>
            <span class="status">Status</span>
            <strong class="price">Total Price: {{$order->cart->totalPrice}}€</strong>
            </div>
        </div>
        @endforeach
    </div>

@endsection