@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/cart.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="cart">
    <h1 class="titel">Shopping Cart</h1>
    @if(Session::has('cart'))
        <ul class="cartWrap">
            @if(count($products)>0)
                @foreach((array)$products as $product)
                    <li class="items">
                            <div class="infoWrap" >
                            <img class="itemImg" src="{{asset('images/'.$product['item']['image'])}}" alt="{{$product['item']['name']}}">
                            </div>
                                <div class="infoWrap">
                                <h3>{{$product['item']['name']}}</h3>
                                <p>Size {{$product['item']['size']}} </p>
                                <p>Quantity: {{$product['qty']}}</p>
                                <p>per Item {{$product['price']}} € </p>
                            </div>
                            <div class="removeWrap">
                                <a href="#" class="remove"><i class="fas fa-times"></i></a>
                            </div>

                    </li>
                @endforeach
            @else
                <span>nix gefunden</span>
            @endif
                <div class="final">
                    <p>Total Price: {{$totalPrice}} €</p>
                    <button>Check Out</button>
                </div>
        </ul>
    </div>
    @else
        <div class="row">
            <div class="col">
                <h2>No Item in Chart <a href="{{route("shop.index")}}">continue shopping</a></h2>
            </div>
        </div>
    @endif
@endsection