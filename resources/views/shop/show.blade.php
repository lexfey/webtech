<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
?>

@extends('layouts.app')
@section('script')
    <script type="text/javascript" src="{{ asset('js/productslide.js') }}"></script>
@endsection

@section('stylesheet')
    <link href="{{ asset('css/product.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="mainContent">
        <div class="column-left">
            <!-- Container for the image gallery -->
            <div class="container">
                <!-- Full-width images -->
                <div class="mySlides">
                    <img class="img" src="{{asset('images/'.$product->image)}}" style="width:100%">
                    @if($product->sizeS=='0' && $product->sizeM=='0'&& $product->sizeL=='0')
                        <img class="imgOverlayer" src="{{asset('img/soldout2.png')}}" style="width:100%">
                    @endif
                </div>
                <div class="mySlides">
                    <img class="img" src="{{asset('images/'.$product->image2)}}" style="width:100%">
                    @if($product->sizeS=='0' && $product->sizeM=='0'&& $product->sizeL=='0')
                        <img class="imgOverlayer" src="{{asset('img/soldout2.png')}}" style="width:100%">
                    @endif
                </div>
                <div class="mySlides">
                    <img class="img" src="{{asset('images/'.$product->image3)}}" style="width:100%">
                    @if($product->sizeS=='0' && $product->sizeM=='0'&& $product->sizeL=='0')
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
                        <img class="demo cursor" src="{{asset('images/'.$product->image)}}" style="width:100%"
                             onclick="currentSlide(1)">
                    </div>
                    @if($product->image2!=null)
                        <div class="column">
                            <img class="demo cursor" src="{{asset('images/'.$product->image2)}}" style="width:100%"
                                 onclick="currentSlide(2)">
                        </div>
                    @endif
                    @if($product->image3!=null)
                        <div class="column">
                            <img class="demo cursor" src="{{asset('images/'.$product->image3)}}" style="width:100%"
                                 onclick="currentSlide(3)">
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="column-right">
            <form action="addToCart/{{$product->id}}" method="get">
                <div class="product_description">
                    <p class="product_name">{{$product->name}}</p>
                    <p class="product_price">{{$product->price}}€</p>

                    <p class="desc">{{$product->descr}}</p>
                </div>

                <div class="product_description">
                    <p class="lables">Color: {{$product->color}}</p>
                </div>
                <br>
                <div class="product_description">
                    @if($product->sizeS=='0' && $product->sizeM=='0'&& $product->sizeL=='0')
                        <p class="info">Sorry we are sold out at the moment</p>
                    @else
                        <p class="labels">Select your size:</p>
                        @if($product->sizeS>'0')
                            <span>{{ Form::radio('size', 'small') }} Small <span class="info">({{$product->sizeS}})</span></span>
                        @endif
                        @if($product->sizeM>'0')
                            <span>{{ Form::radio('size', 'medium') }} Medium <span class="info">({{$product->sizeM}})</span></span>
                        @endif
                        @if($product->sizeL>'0')
                            <span>{{ Form::radio('size', 'large') }} Large <span class="info">({{$product->sizeL}})</span></span>
                        @endif
                        <br>
                        <br>
                        <a href="#">Sizetable</a>
                    @endif
                </div>

            @if(!Auth::guest() && Auth::user()->name == 'Admin')
                <!--Nur für Admin-->
                    <a href="/shop/{{$product->id}}/edit" class="btn adminBtn" id="Button">
                        edit Product
                    </a>
                @else
                    @if($product->sizeS=='0' && $product->sizeM=='0'&& $product->sizeL=='0')
                        <a href="{{ route('shop.index') }}" class="AddToCart">Back to Store</a>
                    @else
                        <input type="submit" class="AddToCart" name="submitButton" value="Add to Cart">
                    @endif
                @endif

            </form>

        </div>
    </div>
@endsection