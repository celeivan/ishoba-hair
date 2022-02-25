@extends('layouts.public')

@section('content')
<div class="cart bg-white p-4">
    <h2 class="text-center">Shopping Cart</h2>
    <hr />

    @if(\Cart::getContent()->count() > 0)
    @if(!$shippingMethod)
    <p class="alert alert-info text-center">Please let us know if you'd to collect your order or if you'd like us to
        courier it to you at R 100.00 flat fee, nationally. {{ $shippingMethod}}</p>
    @endif

    <div class="{{$shippingMethod ? 'bg-success': 'bg-warning' }} bg-opacity-50 p-2">
        <div class="form-check form-check-inline">
            <input autocomplete="off" class="form-check-input" type="radio" {{$shippingMethod === 'courier' ? 'checked': ''}}
                name="shippingMethod" value="courier">
            <label class="form-check-label" for="shippingMethod">
                Courier
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input autocomplete="off" class="form-check-input" {{$shippingMethod === 'collect' ? 'checked': '' }} type="radio"
                name="shippingMethod" value="collect">
            <label class="form-check-label" for="shippingMethod_Collect">
                Collect
            </label>
        </div>
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse (\Cart::getContent()->sortBy('name') as $item)
            <tr>
                <td>{{ ucfirst($item->name) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>R {{ number_format($item->attributes->unitPrice, 2)}}</td>
                <td class="text-end">R {{ number_format(($item->attributes->unitPrice *$item->quantity) , 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <p class="alert alert-info">You have no items in your cart, buy some from <a
                            href="{{ route('public.shop')}}">our shop</a></p>
                </td>
            </tr>
            @endforelse
        </tbody>
        @if(\Cart::getContent()->count() > 0)
        <tfoot>
            <tr>
                <td colspan="2" class="border-0"></td>
                <th>Sub-Total</th>
                <th class="text-end">R {{ number_format(\Cart::getSubTotal(), 2)}}</th>
            </tr>
            <tr>
                <td colspan="2" class="border-0"></td>
                <th>Shipping</th>
                <th class="text-end">{{ $shippingMethod === 'courier' ? 'R 100.00':'R 0.00'}}</th>
            </tr>
            <tr>
                <td colspan="2" class="border-0"></td>
                <th>TOTAL</th>
                @if($shippingMethod === 'courier')
                <th class="text-end">R {{ number_format((\Cart::getSubTotal() + 100), 2)}}</th>
                @else
                <th class="text-end">R {{ number_format((\Cart::getSubTotal()), 2)}}</th>
                @endif
            </tr>
        </tfoot>
        @endif
    </table>

    @if(\Cart::getContent()->count() > 0)
    <div class="terms">
        <p>By Checking out this cart and proceeding to the payment gateway, you confirm that you've read and understood
            our <a href="{{route('public.terms-and-conditions')}}">Terms and Conditions</a> as well as the shipping arrangements.</p>


        <div class="d-flex justify-content-around">
            <a href="{{ route('public.clear-shopping-cart')}}" class="btn btn-outline-light text-black">Clear Cart</a>
            <a href="{{ route('public.checkout')}}" class="btn btn-success {{ !$shippingMethod ? 'disabled': ''}}">Confirm Order</a>
            {{-- <a href="" class="btn btn-info">Download ProForma Invoice</a> --}}
        </div>
    </div>

    <div class="steps mt-4 d-flex justify-content-center align-items-center">
        <button class="btn rounded btn-success">Confirm Order</button>
        <i class="fas fa-chevron-right text-success mx-2 fa-lg"></i>
        <button class="btn rounded btn-primary">{{ $shippingMethod === 'courier' ? 'Delivery ': 'Client' }} Information</button>
        <i class="fas fa-chevron-right text-info mx-2 fa-lg"></i>
        <button class="btn rounded btn-primary">Checkout</button>
        <i class="fas fa-chevron-right text-info mx-2 fa-lg"></i>
        <button class="btn rounded btn-primary">Done <i class="fas fa-crown"></i></button>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $("input[type='radio'][name='shippingMethod']").on('change', async function(e){
        if(jQuery.inArray(e.target.value, ['courier','collect']) === -1){
            Swal.fire({
                    icon: "error",
                    title: "Unknown shipping method",
                    showConfirmButton: true,
                    timer: 3000,
                })
            return false;
        }

        const rawResponse = await fetch(`/api/set-shipping-method/${e.target.value}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                // body: JSON.stringify({shipping: productId}),
            });

            const content = await rawResponse.json();
            let {error, message} = content
            if(error == null){
                Swal.fire({
                    icon: "success",
                    title: message,
                    showConfirmButton: true,
                    confirmButtonText: "Reload",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();      
                    }
                })
            }else{
                Swal.fire({
                    icon: "error",
                    title: message,
                    toast: true,
                    showConfirmButton: false,
                    position: "top-right",
                    timer: 3000,
                })
            }

    });

    let removeItem = async (itemId) =>{
        console.log("Remove item called")
    }

    let reduceItemQty = async (itemId)=>{
        console.log("Reduce item qty called")
    }

    let addItemQty = async (itemId) =>{
        console.log("Add item qty called")
    }
</script>
@endsection