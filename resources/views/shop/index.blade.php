@extends('layouts.app')

@section('content')

 <div class="row">
        <div class="column side">
            <h2>Side</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
            <!--ToDo überprüfe ob admin rechte -->
            <a href="shop/create" class="btn" id="Button">
                add Product
            </a>
             <a href="shop/edit" class="btn" id="Button">
                edit Product
            </a>
        </div>
        <div class="column middle">
            <!--Get Products from Database-->

            @if(count($products)>0)
                  @foreach($products as $product)
                    <div class="gallery">
                         <a href="shop/{{$product->id}}">
                         <img src="/storage/images/{{$product->image}}" alt="{{$product->name}}">
                        </a>
                        <div class="desc">{{$product->descr}}</div>
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
            <div class="gallery">
                <a  href="#">
                    <img src="img/shop2.jpeg" alt="Forest" width="800" height="800">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a  href="#">
                    <img src="img/shop3.jpg" alt="Forest" width="800" height="800">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a  href="#">
                    <img src="img/shop4.jpg" alt="Fjords" width="800" height="800">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a  href="#">
                    <img src="img/shop5.jpg" alt="Forest" width="800" height="800">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a  href="#">
                    <img src="img/shop6.jpg" alt="Forest" width="800" height="800">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            @endif

        </div>    <!--toDo bind phpFile that creats for each Product one Gallary-->
    </div>
@endsection