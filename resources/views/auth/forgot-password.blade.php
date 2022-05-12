@extends('layouts.public')
@section('content')
<div class="container bg-light flex-grow-1 d-flex justify-content-center align-content-center align-items-center flex-column">

    <h3 class="text-uppercase">Reset Password</h3>
    <hr class="w-50 p-0 m-0"/>

    <div class="col-md-4 mt-4">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('password.email') }}" method="POST" id="customerInfo" class="contact-form row g-3">
            @csrf
            <div class="form-floating">
                <input name="email" required type="email" value="{{ old('email') }}" class="form-control" placeholder="">
                <label for="email" class="form-label">Email Address</label>
            </div>
            <div class="col-12 actions">
                <button type="submit" class="btn btn-success submit float-end">Email Link</button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
