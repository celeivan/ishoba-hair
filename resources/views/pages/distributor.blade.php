@extends('layouts.public')
@section('content')
<div class="container shop">
    <p class="alert alert-info m-0">
        Buy in bulks and get amazing discounts
    </p>
    @foreach($products as $product)
    @if(strtolower($product['name']) != 'combo')
    <div class="block bg-white mt-4">
        <div class="header">
            <h2>10 <span class="fs-6">x</span> {{ $product['name'] }}</h2>
            <hr />
        </div>
        <div class="product d-flex flex-wrap flex-md-nowrap">
            <div class="productImage col-12 col-md-3">
                <img src="{{ $product['imageUrl']}}" class="img-fluid" />
            </div>
            <div
                class="description d-flex flex-column justify-content-center align-items-center align-content-center flex-grow-1">
                <p class="pt-1 pt-md-0">
                    {{ $product['description'] }}
                </p>
                <div class="actions d-flex justify-content-center align-content-center">
                    <span class="m-0 p-0 price">R {{number_format(($product['price']-15)*10, 2)}}</span>
                    <button class="btn btn-warning addToCart text-uppercase mx-4 rounded fw-bold"
                        data-productId="{{$product['id']}}">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>

@endsection

@section('scripts')
<script type="">
    $(document).ready(function(){
        $('.addToCart').click(async function(){
            let productId = $(this).attr('data-productId');

            const rawResponse = await fetch(`/api/add-to-cart`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    productId: productId,
                    distributor: true,
                }),
            });

            const content = await rawResponse.json();
            let {error, message} = content
            if(error == null){
                Swal.fire({
                    icon: "success",
                    title: message,
                    toast: true,
                    showConfirmButton: false,
                    position: "top",
                    timer: 3000,
                })
            }else{
                Swal.fire({
                    icon: "error",
                    title: message,
                    toast: true,
                    showConfirmButton: false,
                    position: "top",
                    timer: 3000,
                })
            }
        })
    });
</script>
@endsection