@extends('layouts.public')
@section('content')
<div class="container-fluid">
    <div class="bg-light p-4 mx-4">
        <h3 class="text-uppercase text-center">Welcome back, {{$user->firstNames}} {{ $user->lastName}}</h3>
        <hr />

        <p>
            This is your dashboard, you can do various things, such as updating your profile, managing your orders and
            posting comments/questions about your order.
        </p>

        <div>
            <a href="">Orders</a>
            <a href="">Edit Profile</a>
            <a href="">Communication</a>
        </div>

        
        <table class="table table-responsive table-sm table-hover mt-4">
            <thead>
                <tr>
                    <th>Created When</th>
                    <th>Order Ref</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Shipping Method</th>
                    <th>Item/s</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->orders as $order)
                <tr>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('secure.customer.customerOrder', $order->order_reference) }}">
                            {{$order->order_reference}}</a></td>

                    <td>R {{ $order->shippingAddress === null ? number_format($order->total,2) :
                        number_format($order->total+\App\Models\Order::$shippingFee,2) }}</td>
                    <td>
                        <span>{{$order->status}}</span><br />
                        <span>{{$order->statusDescription}}</span>
                    </td>
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
                    <td colspan="6">
                        <p class="alert alert-info text-center m-0 p-1">No orders yet</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection