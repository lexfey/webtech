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
    <link href="{{ asset('css/product.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="mainContent"  >
    <div class="column-left">
        <!-- todo Status mit einbinden-->
        <!-- Container for the image gallery -->
        <div class="container">
            <!-- Full-width images -->
            <div class="mySlides">
                 <img class="img" src="{{asset('images/'.$product->image)}}" style="width:100%">
                @if($product->status == 'out')
                 <img class="imgOverlayer" src="{{asset('img/soldout2.png')}}" style="width:100%">
                @endif
            </div>
            <div class="mySlides">
                 <img  class="img" src="{{asset('images/'.$product->image2)}}" style="width:100%">
                @if($product->status == 'out')
                    <img class="imgOverlayer" src="{{asset('img/soldout2.png')}}" style="width:100%">
                @endif
            </div>
            <div class="mySlides">
                 <img  class="img" src="{{asset('images/'.$product->image3)}}" style="width:100%">
                @if($product->status == 'out')
                    <img class="imgOverlayer" src="{{asset('img/soldout2.png')}}" style="width:100%">
                @endif
            </div>


            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <br>

            <!-- Thumbnail images -->
            <div class="row">
                <div class="column">
                    <img class="demo cursor" src="{{asset('images/'.$product->image)}}" style="width:100%" onclick="currentSlide(1)" >
                </div>
                @if($product->image2!=null)
                <div class="column">
                    <img class="demo cursor" src="{{asset('images/'.$product->image2)}}" style="width:100%" onclick="currentSlide(2)" >
                </div>
                @endif
                @if($product->image3!=null)
                <div class="column">
                    <img class="demo cursor" src="{{asset('images/'.$product->image3)}}" style="width:100%" onclick="currentSlide(3)" >
                </div>
                @endif
             </div>
        </div>  
    </div>


    <div class="column-right">
       <form action="addToCart/{{$product->id}}" method="get" >
            <div class="product_description">
                <p class="product_name">{{$product->name}}</p>
                <p class="product_price">{{$product->price}}</p>
                @if($product->quantity == 0)
                <p class="info"> Sorry we are sold out right now, check again for more later </p>
                @else
                <p class="info"> Just {{$product->quantity}} more available</p>
                @endif
                <p>{{$product->descr}}</p>
            </div>

            <div class="product_description">
                <p class="lables">Color:  {{$product->color}}</p>
            </div>

            <div class="product_description">
                <p class="lables">Size:  <span>{{$product->size}}</span></p>
                 <a href="#">Sizetable</a>
            </div>


             @if(!Auth::guest() && Auth::user()->name == 'Admin')
                 <!--Nur für Admin-->
                    <a href="/shop/{{$product->id}}/edit" class="btn adminBtn" id="Button">
                        edit Product
                    </a>
            @else
                @if($product->status == 'av')
                    <input type="submit" class="AddToCart" name="submitButton" value="Add to Cart">
                 @else
                     <a href="{{ route('shop.index') }}" class="btn adminBtn" id="Button"> Back to Store</a>
                @endif
           @endif

       </form>

    </div>
</div>
@endsection