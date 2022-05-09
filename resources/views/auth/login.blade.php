@extends('layouts.public')
@section('content')
<div class="container bg-light flex-grow-1 d-flex justify-content-center align-content-center align-items-center flex-column">

    <h3 class="text-uppercase">Login</h3>
    <hr class="w-50 p-0 m-0"/>

    <div class="col-md-4 mt-4">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('login')}}" method="POST" id="customerInfo" class="contact-form row g-3">
            @csrf
            <div class="form-floating">
                <input name="email" required type="email" class="form-control" placeholder="">
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
    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
        </div>

        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-button class="ml-3">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form> --}}
</div>
@endsection