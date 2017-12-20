@extends('layouts.app2')

<!--
ToDo with $product->X die daten des produkts aufrufen
-->

@section('content')
<div class="mainContent" >
    <div class="column-left">
        <!-- Container for the image gallery -->
        <div class="container">
            <!-- Full-width images with number text -->
            <div class="mySlides">
                 <img src="public/img/product1.jpg" style="width:100%">
            </div>
            <div class="mySlides">
                 <img src="img/product2.jpg" style="width:100%">
            </div>
            <div class="mySlides">

                 <img src="img/product3.jpg" style="width:100%">
            </div>
            <div class="mySlides">
                 <img src="img/product4.jpg" style="width:100%">
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <br>

            <!-- Thumbnail images -->
            <div class="row">
                <div class="column">
                    <img class="demo cursor" src="img/product1.jpg" style="width:100%" onclick="currentSlide(1)" >
                </div>
                <div class="column">
                    <img class="demo cursor" src="img/product2.jpg" style="width:100%" onclick="currentSlide(2)" >
                </div>
                <div class="column">
                    <img class="demo cursor" src="img/product3.jpg" style="width:100%" onclick="currentSlide(3)" >
                </div>
                <div class="column">
                    <img class="demo cursor" src="img/product4.jpg" style="width:100%" onclick="currentSlide(4)" >
                </div>
             </div>
        </div>  
    </div>
    

    <div class="column-right">
        <form method="post" action="cart.php">
            <div class="product_description">
                <p class="product_name">Hoodie mit Motiv </p>
                <p class="product_price"> 29,99 </p>
            </div>

            <div class="product_description">
            <p class="lables">Color</p>
            <ul class="color_option">   <!--todo once clicked a link reload the size and:- mark choosen color - enable "add to cart" - change pic if possible -->
                <li class="color"><a href="#"><img src="img/red.png"></a></li>
                <li class="color"><a href="#"><img src="img/green.png"></a></li>
                <li class="color"><a href="#"><img src="img/yellow.jpe"></a></li>
            </ul>
            </div>

            <div class="product_description">
            <span class="lables">Size</span><span class="product_options">
                <select name="Size">
                    <option value="null">    </option>
	                <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </span>
            <a href="#">Sizetable</a>
            </div>

            <input type="submit" class="AddToCart" name="submitButton" value="Add to Cart">
        </form>
    </div>
</div>
@endsection