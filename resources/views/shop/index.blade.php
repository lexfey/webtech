@extends('layouts.app')

@section('content')

 <div class="row">
        <div class="column side">
            <h2>Side</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>

            <a href="shop/create" class="btn" id="Button">
                add Product
            </a>

            <!--Just for Admin -->
             @if(!Auth::guest())
                @if(Auth::user()->name == 'Admin')
                    <a href="shop/create" class="btn" id="Button">
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
                         <img src="images/{{$product->image}}" alt="{{$product->name}}">
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
            @endif

        </div>    <!--toDo bind phpFile that creats for each Product one Gallary-->
    </div>
@endsection