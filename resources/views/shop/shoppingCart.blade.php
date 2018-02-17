<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
?>
@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/cart.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">
    <div class="cart">
    <h1 class="titel">Shopping Cart</h1>
        @if(Session::has('cart'))
            <ul class="cartWrap">
                @if(count($products)>0)
                    @foreach((array)$products as $product)
                        <li class="items">
                            <div class="infoWrap" >
                            <a href="shop/{{$product['item']['id']}}"><img class="itemImg" src="{{asset('images/'.$product['item']['image'])}}" alt="{{$product['item']['name']}}"></a>
                            </div>
                                <div class="infoWrap">
                                <h3>{{$product['item']['name']}}</h3>
                                <p>Size: {{$product['item']['size']}} </p>
                                <p>Quantity:
                                    @if($product['item']['quantity'] > 0)
                                    <a href="removeOneFromCart/{{$product['item']['id']}}"><i class="fas fa-arrow-left"></i></a>
                                    @endif
                                    {{$product['qty']}}
                                    @if($product['item']['quantity'] > $product['qty'])
                                    <a href="addOneToCart/{{$product['item']['id']}}"><i class="fas fa-arrow-right"></i></a>
                                    @endif
                                </p>
                                <p>Price: {{$product['price']}} € </p>
                            </div>
                            <div class="removeWrap">
                                <a href="deleteFromCart/{{$product['item']['id']}}" class="remove"><i class="fas fa-times"></i></a>
                            </div>
                        </li>
                    @endforeach
                    <div class="final">
                        <p>Total Price: {{$totalPrice}} €</p>
                        <a href="{{route("checkout")}}" id="submitButton" class="checkout">Check Out</a>
                    </div>
                @else
                    <div class="cartWrap">
                        <h2>No Item in Cart <a href="{{route("shop.index")}}">continue shopping</a></h2>
                    </div>
                @endif
            </ul>
        @else
            <div class="cartWrap">
                <h2>No Item in Cart <a href="{{route("shop.index")}}">continue shopping</a></h2>
            </div>
        @endif
    </div>
    </div>
@endsection