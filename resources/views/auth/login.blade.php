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
                    <div class="inputBoxImage">
                        <img class="inputBoxImg" src="{{ url('dashboardicons/mail.png') }}" alt="MailIcon">
                    </div>
                    <div class="inputBox">
                        <input id="email" name="email" type="email" autocomplete="email" required  >
                    </div>
                </div>
                <label for="password" >Password</label>
                <div class="authFormGroup">
                    <div class="inputBoxImage">
                        <img class="inputBoxImg" src="{{ url('dashboardicons/eye.png') }}" alt="EyeArrowIcon">
                    </div>
                    <div class="inputBox">
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
