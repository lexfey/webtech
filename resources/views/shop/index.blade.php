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
    <link href="{{ asset('css/shop.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="column side">
            <!--Just for Admin -->
             @if(!Auth::guest())
                @if(Auth::user()->name == 'Admin')
                    <a href="{{route('shop.create')}}"  class="adminBtn">
                        add Product
                    </a>
                @endif
            @endif
        </div>
        <div class="column middle">
            <!--Get Products from Database-->
            @if(count($products)>0)
              @foreach($products as $product)
                <div class="gallery">
                    <a href="shop/{{$product->id}}">
                     <img src="{{asset('images/'.$product->image)}}" alt="{{$product->name}}">
                    </a>
                    <div class="desc">
                        <p>{{$product->name}}</p>
                        <strong>{{$product->price}} EUR{{$product->size}}</strong>
                    </div>
                </div>
              @endforeach
            @else
            <!--Default Pics-->
            <div class="gallery">
                <a href="shop/show">
                    <img src="img/shop1.jpg" alt="Fjords" width="800" height="800">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection