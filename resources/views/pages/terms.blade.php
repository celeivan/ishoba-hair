@extends('layouts.public')

@section('content')
<div class="terms bg-light p-4">
    <h4 class="text-center">Terms and Conditions</h4>
    <hr/>

    <ol>
        <li>
            <h5>Introduction:</h5>
            <ul>
                <li>This website is owned and operated by iShoba Hair Brand and Stressless Group</li>
                <li>The Terms and Conditions govern the purchasing, sale and delivery of Goods, and the use of the
                    Website.</li>
                <li>These Terms and Conditions because they are important and should be carefully noted.</li>
                <li>If there is any provision in these Terms and Conditions that you do not understand, it is your
                    responsibility to ask iShoba Hair to explain it to you before you accept the Terms and Conditions.
                </li>
            </ul>
        </li>
        <li>
            <h5>Returns</h5>
            <ul>
                <li>Should you not be happy with our product you may return it to us for a full refund, provided that
                    the product is still in the same condition as it was delivered to you.</li>
                {{-- //REVIEW: time frame --}}
            </ul>
        </li>
        <li>
            <h5>Registration and use of the website</h5>
            <ul>
                <li>Only registered users may order Goods on the Website.</li> {{-- //REVIEW: how accurate is this??
                --}}
                <li>You agree to enter the correct username and password whenever ordering Goods, failing which you will
                    be denied access.</li>
                <li>You agree to notify iShoba Hair immediately upon becoming aware of or reasonably suspecting any
                    unauthorised access to or use of your username and password and to take steps to mitigate any
                    resultant loss or harm.</li>
            </ul>
        </li>
        <li>
            <h5>Payment</h5>
            <ul>
                <li>We are committed to providing secure online payment facilities</li>
                <li>Payments may be made for products purchased in this website via Instant EFT</li>
            </ul>
        </li>
        <li>
            <h5>Delivery of products</h5>
            <ul>
                <li>iShoba Hair offers 2 delivery methods:</li>
                <ul>
                    <li>Courier via Aramex which may take 3 to 15 business days; or</li>
                    <li>Collection from Stressless Health and Beauty Shop on 417 Anton Lembede Street, Durban, 4000</li>
                </ul>
            </ul>
        </li>
        <li>
            <h5>Errors</h5>
            <ul>
                <li>We take all reasonable efforts to accurately reflect the description, availability, purchase price
                    and delivery charges of products on the Website. However, should there be any errors of whatsoever
                    nature on the Website (which are not due to our gross negligence), we shall not be liable for any
                    loss, claim or expense relating to a transaction based on any error, save – in the case of any
                    incorrect purchase price – to the extent of refunding you for any amount already paid.</li>
            </ul>
        </li>
        <li>
            <h5>Disclaimer</h5>
            <ul>
                <li>The use of the Website is entirely at your own risk and you assume full responsibility for any risk
                    or loss resulting from use of the Website or reliance on any information on the Website.</li>
            </ul>
        </li>
        <li>
            <h5>Complaints</h5>
            <ul>
                <li>If you have a complaint about the products or services provided by iShoba Hair please <a href="{{route('public.contact')}}">contact us</a></li>
            </ul>
        </li>
    </ol>

</div>
@endsection