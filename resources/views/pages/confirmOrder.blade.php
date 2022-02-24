@extends('layouts.public')

@section('content')
<div class="confirmOrder">
    <h2>Order Confirmation (<span class="text-secondary">ISH-</span><span>{{$order->order_reference}}</span>)</h2>

    <p>Thank you for shopping with us, please preview your order and if all the details and amount are correct, then
        make the payment and send proof of payment to us if you used EFT.</p>

    <h4>Customer Details</h4>
    <dl class="row">
        <dt class="col-sm-3">First Name/s</dt>
        <dd class="col-sm-9">{{ $order->customer->firstNames}}</dd>

        <dt class="col-sm-3">Last Name</dt>
        <dd class="col-sm-9">{{ $order->customer->lastName}}</dd>

        <dt class="col-sm-3">Contact No</dt>
        <dd class="col-sm-9">{{ $order->customer->hiddenNumber()}}</dd>

        <dt class="col-sm-3">Email Address</dt>
        <dd class="col-sm-9">{{ $order->customer->hiddenEmail() }}</dd>
    </dl>
    <h4>Order Details</h4>
    <dl class="row">
        <dt class="col-sm-3">Order Reference</dt>
        <dd class="col-sm-9">ISH-{{ $order->order_reference }}</dd>

        <dt class="col-sm-3">Order Total</dt>
        <dd class="col-sm-9">R {{ number_format($order->total,2) }}</dd>

        <dt class="col-sm-3">Courier</dt>
        <dd class="col-sm-9">{{ $shippingMethod === 'courier' ? 'R 100.00':'R 0.00'}}</dd>

        <dt class="col-sm-3">Grand Total</dt>
        @if($shippingMethod === 'courier')
        {{-- <th class="text-end">R {{ number_format((\Cart::getSubTotal() + 100), 2)}}</th> --}}
        <dd class="col-sm-9">R {{ number_format($order->total+100,2) }}</dd>
        @else
        {{-- <th class="text-end">R {{ number_format((\Cart::getSubTotal()), 2)}}</th> --}}
        <dd class="col-sm-9">R {{ number_format($order->total,2) }}</dd>
        @endif

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

    <p>Please note that we do not process payments, we make use of a payment gateway, we will now redirect you to their
        website so you can complete your payment.</p>
    {{-- $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za'; --}}

    <form method="POST" id="pf-form"
        action="https://{{ App::environment('local') ? 'sandbox.payfast.co.za' :'www.payfast.co.za' }}/eng/process">

        @foreach($pfData as $name=> $value)
        <input name="{{$name}}" type="hidden" readonly value="{{ $value }}" />
        @endforeach
    </form>
    
    <button type="button" onclick="$('#pf-form').trigger('submit')" class="btn mx-2 btn-primary">Pay Online Now</button>
    <button type="button" class="btn mx-2 btn-warning">Pay Via EFT</button>
    <button type="button" class="btn mx-2 btn-success">I have made the payment</button>
</div>
@endsection