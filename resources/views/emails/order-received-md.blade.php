@component('mail::header')
<img class="img-responsive logo" alt="ishobahair logo" src="http://ishoba.co.za/images/ishobalogo.png"/>
<h1>Ishoba Hair</h1>
@endcomponent
@component('mail::message')

<h3>{{ $data['heading'] }}</h3>
Order Notifications - {{ $data['order']['order_reference']}}

@if(!empty($data['body']))
<p>{!! $data['body'] !!}</p>
@endif

You can add comments or make payments for your <a href="https://ishoba.co.za/dashboard/order/{!!$data['order']['order_reference']!!}">order</a> via our website <a href='https://ishoba.co.za'>customer portal</a>

Thank You,<br>
Ishoba Hair
@endcomponent
