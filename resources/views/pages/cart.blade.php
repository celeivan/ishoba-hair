@php
use App\Models\Order;
@endphp

@extends('layouts.public')

@section('content')
<div class="container cart bg-white p-4">
    <h2 class="text-center">Shopping Cart</h2>
    <hr />

    @if(\Cart::getContent()->count() > 0)
    @if(!$shippingMethod)
    <p class="alert alert-info text-center">Please let us know if you'd to collect your order or if you'd like us to
        courier it to you at R 100.00 flat fee, nationally. {{ $shippingMethod}}</p>
    @endif

    <div class="{{$shippingMethod ? 'bg-success': 'bg-warning' }} bg-opacity-50 p-2">
        <div class="form-check form-check-inline">
            <input autocomplete="off" class="form-check-input" type="radio" {{$shippingMethod==='courier' ? 'checked'
                : '' }} name="shippingMethod" value="courier">
            <label class="form-check-label" for="shippingMethod">
                Courier
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input autocomplete="off" class="form-check-input" {{$shippingMethod==='collect' ? 'checked' : '' }}
                type="radio" name="shippingMethod" value="collect">
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
                <th scope="col" class="text-end">Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse (\Cart::getContent()->sortBy('name') as $item)
            <tr>
                <td>{{ ucfirst($item->name) }}</td>
                @php
                $explodeCartId = explode('_', $item->id);
                @endphp
                <td>
                    <div class="col-12 col-md-2 text-center">
                        @if($explodeCartId[1] == 0)
                        <input onchange="changeItemQty('{{ $item->id }}')" id="qty_{{ $item->id }}"
                            class="form-control border-0" type="number" value="{{ $item->quantity }}" min='1' max='9' />
                        @else
                        {{ $item->quantity }}
                        @endif
                    </div>
                </td>
                <td>R {{ number_format($item->getPriceWithConditions(), 2)}}</td>
                <td class="text-end">R {{ number_format(($item->getPriceSumWithConditions()) , 2) }}</td>
                <td>
                    <i class="fa-solid fa-xmark text-danger" onclick="removeItem('{{ $item->id }}')"></i>
                </td>
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
            @if(\Cart::getConditions('discount'))
            @endif
            <tr>
                <td colspan="2" class="border-0"></td>
                <th>Shipping</th>
                <th class="text-end">{{ $shippingMethod === 'courier' ? 'R '.number_format(Order::$shippingFee,2):'R
                    0.00'}}</th>
            </tr>
            <tr>
                <td colspan="2" class="border-0"></td>
                <th>TOTAL</th>
                @if($shippingMethod === 'courier')
                <th class="text-end">R {{ number_format((\Cart::getSubTotal()+Order::$shippingFee), 2)}}</th>
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
            our <a href="{{route('public.terms-and-conditions')}}">Terms and Conditions</a> as well as the shipping
            arrangements.</p>


        <div class="d-flex justify-content-around">
            <a href="{{ route('public.clear-shopping-cart')}}" class="btn btn-outline-light text-black">Clear Cart</a>
            <a href="{{ route('public.checkout')}}"
                class="btn btn-success {{ !$shippingMethod ? 'disabled': ''}}">Confirm Order</a>
        </div>
    </div>

    <div class="steps mt-4 d-flex justify-content-center align-items-center">
        <button class="btn rounded btn-success">Confirm Order</button>
        <i class="fas fa-chevron-right text-success mx-2 fa-lg"></i>
        <button class="btn rounded btn-primary">{{ $shippingMethod === 'courier' ? 'Delivery ': 'Client' }}
            Information</button>
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
            });

            const content = await rawResponse.json();
            let {error, message} = content
            if(error == null){
                Swal.fire({
                    icon: "success",
                    title: message,
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();      
                    }else{
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
        const rawResponse = await fetch(`/api/remove-item-from-cart`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }, 
                body: JSON.stringify({
                    cartId: itemId,
                }),
            });

            const content = await rawResponse.json();
            let {error, message} = content
            if(error == null){
                Swal.fire({
                    icon: "success",
                    title: message,
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();      
                    }else{
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
    }

    let changeItemQty = async (itemId)=>{
        let qty = $(`#qty_${itemId}`).val();

        const rawResponse = await fetch(`/api/change-item-qty`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }, 
                body: JSON.stringify({
                    cartId: itemId,
                    qty: qty
                }),
            });

            const content = await rawResponse.json();
            let {error, message} = content
            if(error == null){
                Swal.fire({
                    icon: "success",
                    title: message,
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();      
                    }else{
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
    }

</script>
@endsection