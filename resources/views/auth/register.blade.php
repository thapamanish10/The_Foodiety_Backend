<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foodiety/Register</title>
        <link rel="stylesheet" href="{{ asset('./css/auth.css') }}">
</head>
<body>
    <div class="authContainer">
        <div class="authContainerCard">
        <div class="authHeading">
            {{-- <img class="authLogo" src="{{ asset('./assets/logo.png') }}" alt="Your Company"> --}}
            <h2 class="authHeadingText">Register</h2>
        </div>

        <div class="">
            <form class="" method="POST" action="{{ route('register') }}">
                @csrf
            <div class="authFormGroup">
                <label for="name" class="">Username</label>
                <input id="name" name="name" type="name" autocomplete="name" required class="">
            </div>

            <div class="authFormGroup">
                <label for="email" class="">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required class="">
            </div>

            <div class="authFormGroup">
                <label for="password" class="">Password</label>
                    <input id="password" 
                        name="password" 
                        type="password" 
                        autocomplete="current-password" 
                        required 
                        class="">
            </div>

            <div class="authFormGroup">
                <label for="password_confirmation" class="">Confirm Password</label>
                    <input id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        autocomplete="new-password" 
                        required 
                        class="">
            </div>

            <div class="authFormGroupButton">
                <button type="submit" class="">Register Now</button>
            </div>
            <div class="authFormGroup">
                <a href="{{ route('login') }}" class="">Already registered?</a>
            </div>
            </form>

        </div>
        </div>
        </div>
</body>
</html>
{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
