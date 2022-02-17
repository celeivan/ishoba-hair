@extends('layouts.public')
@section('content')
<div class="shop">
    @foreach($products as $product)
    <div class="block bg-white mt-4">
        <div class="header">
            <h2>{{ $product['name'] }}</h2>
            <hr />
        </div>
        <div class="product d-flex">
            <div class="productImage col-3">
                <img src="{{ $product['imageUrl']}}" class="img-fluid" />
            </div>
            <div
                class="description d-flex flex-column justify-content-center align-items-center align-content-center flex-grow-1">
                <p class="">
                    {{ $product['description'] }}
                </p>
                <div class="actions d-flex justify-content-center align-content-center">
                    <span class="m-0 p-0 price">R {{number_format($product['price'], 2)}}</span>
                    <button class="btn btn-warning text-uppercase mx-4 rounded fw-bold">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection