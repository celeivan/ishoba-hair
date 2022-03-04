@extends('layouts.public')
@section('content')
<div class="container-fluid bg-light mx-4">
    <div class="container">
        <h1>Manage Order - {{$order->order_reference}}</h1>
        <hr />
        <div class="status">
            <p class="alert alert-info">
                {{ $order->status }} : {{ $order->statusDescription}}
            </p>
        </div>
        
        <div class="row">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-outline-primary">Awaiting Payment</a>
                <a href="#" class="btn btn-outline-primary">Payment Received</a>
                <a href="#" class="btn btn-outline-primary">Shipped</a>
                <a href="#" class="btn btn-outline-primary">Delivered</a>
                <a href="#" class="btn btn-outline-primary">Cancel</a>
                {{-- <a href="#" class="btn btn-outline-primary">Edit</a> --}}
              </div>
        </div>

        @php
        if($order->shippingAddress == null){
        $shippingMethod = "Collect";
        $total = $order->total;
        }else{
        $shippingMethod = "Deliver";
        $total = $order->total + 100;
        }
        @endphp
        <div class="row">
            <dl class="row col-md-6">
                <h4 class="mt-4 text-uppercase fw-smaller">Customer Details</h4>
                {{--
                <hr class="col-md-6" /> --}}
                <dt class="col-sm-3">First Name/s</dt>
                <dd class="col-sm-9">{{ $order->customer->firstNames}}</dd>

                <dt class="col-sm-3">Last Name</dt>
                <dd class="col-sm-9">{{ $order->customer->lastName}}</dd>

                <dt class="col-sm-3">Contact No</dt>
                <dd class="col-sm-9">{{ $order->customer->contactNo}}</dd>

                <dt class="col-sm-3">Email Address</dt>
                <dd class="col-sm-9">{{ $order->customer->emailAddress }}</dd>
            </dl>

            <dl class="row col-md-6">
                <h4 class="mt-4 text-uppercase">Order Details</h4>
                {{--
                <hr class="col-md-6" /> --}}
                <dt class="col-sm-3">Order Reference</dt>
                <dd class="col-sm-9">ISH-{{ $order->order_reference }}</dd>

                <dt class="col-sm-3">Order Total</dt>
                <dd class="col-sm-9">R {{ number_format($order->total,2) }}</dd>

                <dt class="col-sm-3">Courier</dt>
                <dd class="col-sm-9">{{ $shippingMethod === 'courier' ? 'R 100.00 - Courier':'R 0.00 - Collect'}}</dd>

                <dt class="col-sm-3">Grand Total</dt>
                <dd class="col-sm-9">R {{ number_format($total,2) }}</dd>
                <dt class="col-sm-3">
                    Items
                </dt>

                <dd class="col-sm-9">
                    <ol class="list-unstyled">
                        @foreach($order->items as $orderItem)
                        <li>{{$orderItem->qty}} x {{$orderItem->product->name}}</li>
                        @endforeach
                    </ol>
                </dd>
            </dl>
        </div>
    </div>
</div>
@endsection