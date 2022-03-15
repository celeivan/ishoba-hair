@component('mail::header')
<img class="img-responsive logo" alt="ishobahair logo" src="http://ishoba.co.za/images/ishobalogo.png"/>
<h1>Ishoba Hair</h1>
@endcomponent
@component('mail::message')
Contact form from - {{$data['name']}}, {{ $data['contactNo'] }}, {{ $data['email'] }}.

<p>Message: {{ $data['formMessage'] ?? '' }}</p>

Thanks,<br>
Ishoba Hair Website
@endcomponent
