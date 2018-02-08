@extends('layouts.app')

<!--
ToDo with $product->X die daten des produkts aufrufen
-->

@section('content')
<div class="mainContent" >
    <div class="column-left">
        <!-- Container for the image gallery -->
        <div class="container">
            <!-- Full-width images -->
            <div class="mySlides">
                 <img src="{{asset('images/'.$product->image)}}" style="width:100%">
            </div>
            <div class="mySlides">
                 <img src="{{asset('images/'.$product->image2)}}" style="width:100%">
            </div>
            <div class="mySlides">

                 <img src="{{asset('images/'.$product->image3)}}" style="width:100%">
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
                <div class="column">
                    <img class="demo cursor" src="{{asset('images/'.$product->image2)}}" style="width:100%" onclick="currentSlide(2)" >
                </div>
                <div class="column">
                    <img class="demo cursor" src="{{asset('images/'.$product->image3)}}" style="width:100%" onclick="currentSlide(3)" >
                </div>
             </div>
        </div>  
    </div>


    <div class="column-right">
       <form action="addToCart/{{$product->id}}" method="get" >
            <div class="product_description">
                <p class="product_name">{{$product->name}}</p>
                <p class="product_price">{{$product->price}}</p>
                <p>{{$product->descr}}</p>
            </div>

            <div class="product_description">
            <p class="lables">Color</p>
            <p class="color">{{$product->color}}</p>
           <!-- <ul class="color_option">    
                <li class="color"><a href="#"><img src="img/red.png"></a></li>
                <li class="color"><a href="#"><img src="img/green.png"></a></li>
                <li class="color"><a href="#"><img src="img/yellow.jpe"></a></li>
            </ul> -->
            </div>

            <div class="product_description">
            <span class="lables">Size</span><span class="product_options">
                <p>{{$product->size}}</p>
                <!--
                <select name="Size">
                    <option value="null">    </option>
	                <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
                -->
            </span>
            <a href="#">Sizetable</a>
            </div>

            <!--Nur für Admin-->
             @if(!Auth::guest())
                @if(Auth::user()->name == 'Admin')
                    <a href="/shop/{{$product->id}}/edit" class="btn" id="Button">
                        edit Product
                    </a>
                @endif
            @endif

        <input type="submit" class="AddToCart" name="submitButton" value="Add to Cart">

       </form>

    </div>
</div>
@endsection