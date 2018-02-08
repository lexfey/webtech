@extends('layouts.app')

@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col">
                <ul class="list-group">
                    @if(count($products)>0)
                        @foreach((array)$products as $product)
                            <span class="right">{{$product['qty']}}</span>
                            <span>{{$product['item']['name']}}</span>
                            <span class="lable">{{$product['price']}}</span>
                            <div class="">
                                <button>Remove</button>
                            </div>
                        @endforeach
                    @else
                        <span>nix gefunden</span>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <strong>Total: {{$totalPrice}}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button>Check</button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col">
                <h2>No Item in Chart <a href="{{route("shop.index")}}">continue shopping</a></h2>
            </div>
        </div>
    @endif
@endsection