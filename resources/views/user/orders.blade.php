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
        <div class="orders">
            @foreach($orders as $order)
                <!--todo link status & shipping number-->
            <div class="panel-body">
                <div class="date">Ordered on the {{$order->created_at}}
                    @if ($order->shipping_Id != null)
                        <span class="id">{{$order->shipping_Id}}</span>
                    @else
                        <span class="id"> Unknown </span>
                    @endif
                    <span class="id">Shipping ID: </span>
                </div>
                <ul class="orders">
                    @foreach($order->cart->items as $item)
                    <li class="order">
                        <span class="badge">{{$item['qty']}}x {{$item['item']['name']}} | {{$item['price']}}€</span>
                    </li>
                    @endforeach
                </ul>
                <div>
                <span class="status">{{$order->status}}</span>
                <strong class="price">Total Price: {{$order->cart->totalPrice}}€</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection