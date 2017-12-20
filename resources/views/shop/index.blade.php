@extends('layouts.app2')

@section('content')

 <div class="row">
        <div class="column side">
            <h2>Side</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
        </div>
        <div class="column middle">
            <!--Get Products from Database-->
            @if(count($products)>1)
                  @foreach($products as $products)
                    <div class="gallery">
                         <a href="shop/{{$products->id}}">
                         <img src={{$products->img}} alt={{$products->name}}>
                        </a>
                        <div class="desc">{{$products->description}}</div>
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
        </div>    <!---toDo bind phpFile that creats for each Product one Gallary --->
    </div>
@endsection