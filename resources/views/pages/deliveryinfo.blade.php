@extends('layouts.public')
@section('content')
<div class="checkout bg-light p-4">
    <h2 class="text-center">{{ $shippingMethod === 'courier' ? 'Delivery Info' : 'Client Info'}}</h2>
    <hr />

    <p>Thank you for shopping with us, enter your email if you're a returning customer.</p>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="existingEmail" placeholder="Your Email"
                    aria-label="Your Email" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary" type="button" id="existingEmailBtn"><i
                        class="fas fa-search"></i></button>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-check">
                <input autocomplete="off" class="form-check-input" type="radio" name="newCustomer" id="newCustomer"
                    value="newCustomer">
                <label class="form-check-label" for="newCustomer">
                    New customer
                </label>
            </div>
        </div>
    </div>

    <hr />
    <div class="customerInfo mt-4">
        <form action="{{ route('public.order-create')}}" method="POST" id="customerInfo" class="contact-form row g-3">
            @csrf
            <div class="col-md-6 form-floating">
                <input name="firstNames" required type="text" class="form-control" placeholder="">
                <label for="firstName" class="form-label">First Name/s</label>
            </div>
            <div class="col-md-6 form-floating">
                <input name="lastName" required type="text" class="form-control" placeholder="">
                <label for="lastName" class="form-label">Last Name</label>
            </div>
            <div class="col-md-6 form-floating">
                <input name="emailAddress" required type="email" class="form-control" placeholder="">
                <label for="email" class="form-label">Email Address</label>
            </div>
            <div class="col-md-6 form-floating">
                <input name="contactNo" required type="text" class="form-control" placeholder="">
                <label for="contactNo" class="form-label">Contact No</label>
            </div>
            @if($shippingMethod === 'courier')
            <div class="col-12 form-floating">
                <input name="shippingAddress" required type="text" class="form-control" placeholder="">
                <label for="shippingAddress" class="form-label">Shipping Address</label>
            </div>
            <div class="form-floating">
                <textarea name="shippingNote" class="form-control" placeholder="Leave a comment here"
                    id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Shipping Note</label>
            </div>
            @endif

            <div class="col-12 actions">
                <button type="submit" class="btn btn-success submit">Next</button>
            </div>
        </form>
    </div>

    @if(\Cart::getContent()->count() > 0)
    <div class="steps mt-4 d-flex justify-content-center align-items-center">
        <a class="btn rounded btn-primary" href="{{route('public.shopping-cart')}}">Confirm Order</a>
        <i class="fas fa-chevron-right text-info mx-2 fa-lg"></i>
        <button class="btn rounded btn-success">Delivery Information</button>
        <i class="fas fa-chevron-right text-primary mx-2 fa-lg"></i>
        <button class="btn rounded btn-primary">Checkout</button>
        <i class="fas fa-chevron-right text-info mx-2 fa-lg"></i>
        <button class="btn rounded btn-primary">Done <i class="fas fa-crown"></i></button>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $(function(){
        $('.customerInfo').hide()
        $('input:radio[name="newCustomer"]').on('change', function(e) {
            if ($(this).is(':checked')) {
                $('#customerInfo').trigger('reset');
                $('.customerInfo').show()
            }
        });

        $('#existingEmail').on('focus', function(e) {
            $('input:radio[name="newCustomer"]').prop('checked', false)
        })

        $('#existingEmailBtn').on('click', async function() {
            let email = $('#existingEmail').val();
            console.log("Exisitng email submit ", email)
            if(email == null || email.length < 3){
                Swal.fire({
                    icon: 'error',
                    title: 'Please enter a valid email',
                })
            }else{
                const rawResponse = await fetch(`/api/client-check`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({email: email}),
                });

                const content = await rawResponse.json();
                let {error, message, customer} = content
                if(error == null){
                    if(customer){
                        let {firstNames, lastName, emailAddress, contactNo} = customer
                        $('[name="firstNames"]').val(firstNames)
                        $('[name="lastName"]').val(lastName)
                        $('[name="emailAddress"]').val(emailAddress)
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

        })
    })
</script>
@endsection