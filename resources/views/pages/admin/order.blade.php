@php
use App\Models\Order;
@endphp

@extends('layouts.public')
@section('content')
<div class="container-fluid">
    <div class="bg-light p-1 p-md-4 pt-0 mx-1 mx-md-4">
        <h1> {{Auth::user()->isAdmin() ? 'Manage':'View' }} Order - {{$order->order_reference}}</h1>
        <hr />
        <div class="status">
            <p class="alert alert-info">
                <strong>Order Status</strong>
                {{ ucwords($order->status) }} : {{ $order->statusDescription ?? Order::$orderStatuses[$order->status]}}
            </p>

            @if(!$order->isPaid() && Auth::id() == $order->customer->id)
            <p class="alert alert-warning">
                Go <a href="{{ route('public.confirm-order', $order->order_reference)}}">here</a> to confirm you order and pay online or via EFT.
            </p>
            @endif
        </div>
        <hr/>
        @php
        if(empty($order->shippingAddress)){
            $shippingMethod = "Collect";
            $total = $order->total;
        }else{
            $shippingMethod = "Deliver";
            $total = $order->total  + Order::$shippingFee;
        }
        @endphp
        <div class="row">
            <dl class="row col-md-6">
                <h4 class="mt-4 text-uppercase fw-smaller">Customer Details</h4>
                <dt class="col-sm-3">First Name/s</dt>
                <dd class="col-sm-9">{{ $order->customer->firstNames}}</dd>

                <dt class="col-sm-3">Last Name</dt>
                <dd class="col-sm-9">{{ $order->customer->lastName}}</dd>

                <dt class="col-sm-3">Contact No</dt>
                <dd class="col-sm-9">{{ $order->customer->contactNo}}</dd>

                <dt class="col-sm-3">Email Address</dt>
                <dd class="col-sm-9">{{ $order->customer->email }}</dd>
            </dl>

            <dl class="row col-md-6">
                <h4 class="mt-4 text-uppercase">Order Details</h4>
                <dt class="col-sm-3">Order Reference</dt>
                <dd class="col-sm-9">ISH-{{ $order->order_reference }}</dd>

                <dt class="col-sm-3">Order Total</dt>
                <dd class="col-sm-9">R {{ number_format($order->total,2) }}</dd>

                <dt class="col-sm-3">Courier</dt>
                <dd class="col-sm-9">{{ $shippingMethod === 'Deliver' ? 'R 100.00 - Courier':'R 0.00 - Collect'}}</dd>

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
        <div class="row comments">
            <h4 class="text-center">Order Comments</h4>
            <hr/>

            @forelse ($order->comments as $comment)
                <div class="comment {{$comment->type == 'system' ? 'system' : '' }} {{ $comment->type != 'system' && $comment->user_id === Auth::id() ? 'sent' : 'received'}}">
                    <p class='py-1'>{{$comment->comment}}</p>
                </div>
            @empty
                <div class="no-comments">
                  <p class="alert alert-info">
                      No comments have been added to this order yet, you can start comments bellow
                  </p>
                </div>  
            @endforelse

            <div> 
                <p class='alert alert-info'>
                <strong>Add Comment</strong>
                (this is only visible to customer and store admin/s, it can be a question or anything not offensive)</p>
                
            </div>
            <form action="{{ route('admin.order-comments', $order->id)}}" method="post">
                @csrf
                <textarea name="comment" class="form-control" placeholder="Enter Comment"></textarea>
                <button class="btn btn-primary float-end" type="submit">Post Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection