<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foodiety/Login</title>
    <link rel="stylesheet" href="{{ asset('./css/auth.css') }}">
</head>
<body>
    <div class="authContainer">
        <div class="authContainerCard">
        <div class="authHeading">
            <h2 class="authHeadingText">Login</h2>
        </div>

        <div class="authFormContainer">
            <form class="authForm" method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email" class="">Email</label>
                <div class="authFormGroup">
                    <div class="inputBox">
                        {{-- <img class="inputBoxImg" src="{{ asset('dashboardicons/mail.png') }}" alt="MailIcon"> --}}
                        <input id="email" name="email" type="email" autocomplete="email" required >
                    </div>
                </div>
                <label for="password" >Password</label>
                <div class="authFormGroup">
                    <div class="inputBox">
                        {{-- <img class="inputBoxImg" src="{{ asset('dashboardicons/eye.png') }}" alt="EyeArrowIcon"> --}}
                        <input id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required />
                        </div>
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="authFormRememberME">
                    <div class="authForgotPassword">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>
                </div>
                <div class="authFormGroupButton">
                    <button type="submit" class="">Log in</button>
                </div>
                <a href="{{ route('register') }}" class="authNavigation">Don't have an account? <span>Sign Up here</span></a>
            </div>
            </form>
        </div>
        </div>
        </div>
</body>
</html>



{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}