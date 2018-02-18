<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 08.02.2018
 * Time: 11:37
 */
?>
@extends('layouts.app')

@section('content')

    <h3>Cart Items</h3>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>qty</th>
                <th>size</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cartItems as $cartItem)
            <tr>
                <td>{{$cartItem->name}}</td>
                <td>{{$cartItem->price}}</td>
                <td>{{$cartItem->qty}}</td>
                <td>{{$cartItem->options->has('size')?$cartItem->options->size:''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
