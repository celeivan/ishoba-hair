@component('mail::header')
<img class="img-responsive logo" alt="ishobahair logo" src="http://ishoba.co.za/images/ishobalogo.png"/>
<h1>Ishoba Hair</h1>
@endcomponent
@component('mail::message')

<h3>Dear Ishoba Hair Admin, {{ $data['customer']->firstNames }} {{ $data['customer']->lastName }} has placed an order.</h3>

Order reference - {{ $data['order']['order_reference']}}

<p>Order details</p>
@if(!empty($data['cartItems']))
<ul>
    @forelse($data['cartItems'] as $item)
    <li>
        Item: {{ $item['name'] }} x {{ $item['qty'] }}
    </li>
    @empty 
    @endforelse
</ul>
@endif

<p>Customer Details: name {{ $data['customer']->firstNames }} {{ $data['customer']->lastName }}; contact number {{ $data['customer']->contactNo }}; contact email {{ $data['customer']->email }}.</p>

You can add comments or make payments for your <a href="https://ishoba.co.za/dashboard/order/{!!$data['order']['order_reference']!!}">order</a> via the website <a href='https://ishoba.co.za'>customer portal.</a>

Thank You,<br>
Ishoba Hair
@endcomponent
