@extends('layouts.public')
@section('content')
<div class="container bg-light flex-grow-1 d-flex justify-content-center align-content-center align-items-center flex-column">

    <h3 class="text-uppercase">Reset Password</h3>
    <hr class="w-50 p-0 m-0"/>

    <div class="col-md-4 mt-4">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('password.update') }}" method="POST" class="contact-form row g-3">
            @csrf
            {{-- <!-- Password Reset Token --> --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-floating">
                <input name="email" required type="email" value="{{ old('email') }}" class="form-control" placeholder="">
                <label for="email" class="form-label">Email Address</label>
            </div>
            <div class="form-floating">
                <input name="password" required type="password" class="form-control" placeholder="">
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="form-floating">
                <input name="password_confirmation" required type="password" class="form-control" placeholder="">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
            </div>

            <div class="col-12 actions">
                <button type="submit" class="btn btn-success submit float-end">Reset Password</button>
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

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
