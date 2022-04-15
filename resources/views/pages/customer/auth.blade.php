@extends('layouts.public')

@section('content')
<div
    class="container bg-light flex-grow-1 d-flex justify-content-center align-content-center align-items-center flex-column">

    <h3 class="text-uppercase">Login to Customer Portal</h3>
    <hr class="w-50 p-0 m-0" />

    <div class="col-md-4 mt-4">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('customer-login')}}" method="POST" id="customerInfo" class="contact-form row g-3">
            @csrf
            <div class="form-floating">
                <input name="emailAddress" required type="email" class="form-control" placeholder="">
                <label for="email" class="form-label">Email Address</label>
            </div>
            <div class="form-floating">
                <input name="password" required type="password" class="form-control" placeholder="">
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="col-12 actions">
                <button type="submit" class="btn btn-success submit float-end">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection