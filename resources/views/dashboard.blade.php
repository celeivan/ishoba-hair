@php
use App\Models\Order;
@endphp
@extends('layouts.public')
@section('content')
<div class="container-fluid">
    <div class="bg-light p-1 pt-2 p-md-4  mx-1 mx-md-4">
        <h4 class="text-center">Welcome back <b>{{Auth::user()->firstNames}} {{Auth::user()->lastName}}</b></h4>
        <hr />

        @if(Auth::user()->isAdmin())
            <p class="alert alert-info">You can manage your orders here, you can view otder details by clicking on
            order reference</p>
            
            <p class="alert alert-warning"> 
                Default user credentials user email and password <i>Cust0m3rP</i> <br/>
                Be careful of changing order status, you do not want to give customers false information.
            </p>
        @else
            <p class='alert alert-info'>You can manage your orders here, view order details and add comments (click on the order number to view the order and comments)</p>
        @endif
    </div>
    <div class="bg-light p-1 p-md-4 pt-0 mx-1 mx-md-4">
        <h2 class="text-uppercase">Orders</h2>
        <hr />
        @if(Auth::user()->isAdmin())
        {{-- <p>You can manage your orders here.</p> --}}
        {{-- <div class="btn-group filters d-flex justify-content-evenly" role="group" aria-label="Orders filters">
            <a href="#" class="btn btn-primary">Pending</a>
            <a href="#" class="btn btn-outline-primary">Paid</a>
            <a href="#" class="btn btn-outline-primary">Shipped</a>
            <a href="#" class="btn btn-outline-primary">Delivered</a>
            <a href="#" class="btn btn-outline-primary">Cancelled</a>
        </div> --}}
        @endif

        <div class="table-responsive-md">
            <table class="table table-sm table-hover mt-4">
                <thead>
                    <tr>
                        <th>Created When</th>
                        <th>Order Ref</th>
                        <th>Total</th>
                        <th>Status</th>
                        @if(Auth::user()->isAdmin())
                        <th>Customer</th>
                        @endif
                        <th>Shipping Method</th>
                        <th>Item/s</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="text-nowrap">
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('admin.view-order', $order->order_reference) }}">
                                {{$order->order_reference}}</a></td>

                        <td>R {{ $order->shippingAddress === null ? number_format($order->total,2) :
                            number_format($order->total+\App\Models\Order::$shippingFee,2) }}</td>
                        <td>
                            @if(Auth::user()->isAdmin())
                            <select class="form-control" data-order-ref="{{ $order->order_reference }}" name="orderStatus">
                                @forelse (Order::$orderStatuses as $status => $description)
                                <option value="{{$status}}" {{$status==$order->status ? "selected=selected" : ''}}>{{
                                    ucwords($status) }}</option>
                                @empty
                                @endforelse
                            </select>
                            @else
                                <span>{{ ucwords($order->status) }}</span><br />
                                <span>{{ Order::$orderStatuses[$order->status]}}</span>
                            @endif
                        </td>
                        @if(Auth::user()->isAdmin())
                        <td>{{ $order->customer->firstNames ?? '' }}</td>
                        @endif
                        <td>
                            <span>{{ $order->shippingAddress === null ? 'Collect' : 'Deliver' }}</span><br />
                            <span>{{ $order->shippingAddress}}</span>
                        </td>
                        <td>
                            @forelse($order->items as $item)
                            <span>{{$item->qty}} x {{$item->product->name}}</span><br />
                            @empty
                            @endforelse
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <p class="alert alert-info text-center m-0 p-1">No orders yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function(){
        $('select[name="orderStatus"]').on('change', async function(e) {
            let orderRef = $(this).data('order-ref')
            let status = $(this).val()
            if(orderRef){ 
                const rawResponse = await fetch(`/api/order/${orderRef}/change-status`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        status: status,
                        'user_id': {!! Auth::id() !!}
                    }),
                });

                const content = await rawResponse.json();
                let {error, message, customer} = content
                if(error == null){
                    if(customer){
                        let {firstNames, lastName, email, contactNo} = customer
                        $('[name="firstNames"]').val(firstNames)
                        $('[name="lastName"]').val(lastName)
                        $('[name="email"]').val(email)
                        $('[name="contactNo"]').val(contactNo)
                        $('.customerInfo').show()
                        Swal.fire({
                            icon: "success",
                            title: "User has been populated, please fill address fields and continue",
                            showConfirmButton: true,
                        })
                    }
                }else{
                    Swal.fire({
                        icon: "error",
                        title: message,
                        toast: true,
                        showConfirmButton: false,
                        position: "top-right",
                        timer: 3000,
                    });
                    if(!customer){
                        $('#customerInfo').trigger('reset');
                    }
                }
            }
        });
    });
</script>
@endsection