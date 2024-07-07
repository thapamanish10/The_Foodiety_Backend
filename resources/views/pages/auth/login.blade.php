<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('./css/auth.css') }}">
</head>

<body>
    <main class="auth">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <img src="./assets/logo.png" alt="Logo">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="formGroup">
                <label for="name">Name:</label>
                <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
            </div>
            <div class="formGroup">
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </main>
</body>

</html>
