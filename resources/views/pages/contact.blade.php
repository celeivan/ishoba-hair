@extends('layouts.public')

@section('content')
<div class="contact d-flex flex-column align-items-center">
    <h1>Contact Us</h1>
    <div class="col-md-8">
        <form action="" class="contact-form row g-3">
            <div class="col-md-6 form-floating">
                <input name="firstName" required type="text" class="form-control" placeholder="">
                <label for="firstName" class="form-label">First Name/s</label>
            </div>
            <div class="col-md-6 form-floating">
                <input name="lastName" required type="text" class="form-control" placeholder="">
                <label for="lastName" class="form-label">Last Name</label>
            </div>
            <div class="col-md-6 form-floating">
                <input name="email" required type="email" class="form-control" placeholder="">
                <label for="email" class="form-label">Email Address</label>
            </div>
            <div class="col-md-6 form-floating">
                <input name="contactNo" required type="text" class="form-control" placeholder="">
                <label for="contactNo" class="form-label">Contact No</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Message</label>
              </div>
            <div class="col-12">
                <button type="submit" class="btn btn-warning text-uppercase px-4">Send</button>
            </div>
        </form>
    </div>
</div>
@endsection