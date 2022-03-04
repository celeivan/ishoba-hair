@extends('layouts.public')
@section('content')
<div class="container-fluid bg-light p-4 mx-4">
    <h2 class="text-uppercase">Orders</h2>
    <hr />
    <p>You can manage your orders here.</p>

    <div class="btn-group filters d-flex justify-content-evenly" role="group" aria-label="Orders filters">
        <a href="#" class="btn btn-primary">Pending</a>
        <a href="#" class="btn btn-outline-primary">Paid</a>
        <a href="#" class="btn btn-outline-primary">Shipped</a>
        <a href="#" class="btn btn-outline-primary">Delivered</a>
        <a href="#" class="btn btn-outline-primary">Cancelled</a>
    </div>

    <table class="table table-responsive table-sm table-hover mt-4">
        <thead>
            <tr>
                <th>Created When</th>
                <th>Order Ref</th>
                <th>Total</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Shipping Method</th>
                <th>Item/s</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.view-order', $order->order_reference) }}"> {{$order->order_reference}}</a></td>

                <td>R {{ $order->shippingAddress === null ? number_format($order->total,2) :
                    number_format($order->total+100,2) }}</td>
                <td>
                    <span>{{$order->status}}</span><br/>
                    <span>{{$order->statusDescription}}</span>
                </td>
                <td>{{ $order->customer->firstNames ?? '' }}</td>
                <td class="">
                    <span>{{ $order->shippingAddress === null ? 'Collect' : 'Deliver' }}</span><br />
                    <span>{{ $order->shippingAddress}}</span>
                </td>
                <td class="">
                    @forelse($order->items as $item)
                    <span>{{$item->qty}} x {{$item->product->name}}</span><br />
                    @empty
                    @endforelse
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6"> <p class="alert alert-info text-center m-0 p-1">No orders yet</p> </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection