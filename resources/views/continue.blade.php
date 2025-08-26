<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <section class="login-container">
        <div class="login-container-card">
            <div class="login-container-heading">
                {{-- <h1>The Foodiety</h1> --}}
            </div>
            <div class="login-container-body">
                <div class="form-group-google">
                    <a href="{{ route('google.login') }}" class="google-login-btn google">
                        <img src="{{ url('google.png') }}" alt="Google"> Continue with Google
                    </a>
                </div>
                <div class="or-div">
                    <h4>OR</h4>
                </div>
                <div class="form-group-google">
                    <a href="{{ route('login') }}" class="google-login-btn email-btn">
                        Continue with Email
                    </a>
                </div>
                <div class="sign-up-link">
                    <span>Already have an account? </span>
                    <a href="{{ route('login') }}">Log In</a>
                </div>
                <div class="sign-up-link back-to-home">
                    <a href="{{ url('/') }}"> <span>Back to home </span></a>
                </div>
            </div>
        </div>
    </section>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');

        .login-container {
            width: 100%;
            height: 95vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Raleway", sans-serif;
            font-weight: 600;
            color: #5f5f5f;
            box-sizing: border-box;
        }

        .login-container-card {
            width: 40%;
            margin: auto;
            height: max-content;
        }

        .login-container-heading {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .login-container-heading h1 {
            font-size: 30px;
            margin: .5rem 0;
        }

        .sign-up-link {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sign-up-link span {
            font-size: 14px;
        }

        .sign-up-link a {
            text-decoration: none;
            color: #ffde59;
            font-size: 14px;
        }

        .sign-up-link a:hover {
            text-decoration: underline;
        }

        .login-container-body {
            width: 100%;
            height: 60%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 3rem 0;
        }

        .or-div {
            border-bottom: 1px solid #dddddd7c;
            width: 355px;
            position: relative;
        }

        .or-div h4 {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 15px;
            font-weight: 600;
            color: #5f5f5f;
            transform: translate(-50%, -50%);
            background: #ffffff;
            padding: 0;
            margin: 0;
            padding: 0 2rem;

        }

        .login-container-body-section .form-group-google {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2.3rem 0;
            flex-direction: column;
        }

        .google-login-btn.google {
            border: 1px solid #ffde59 !important;
        }

        .google-login-btn.email-btn {
            border: 1px solid #ffde59 !important;
            background: #ffde59;
            color: #5f5f5f;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;
        }

        .google-login-btn {
            width: 320px;
            height: 40px;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            border: 1px solid #5f5f5f48;
            font-size: 14px;
            text-decoration: none;
            color: #5f5f5f;
            border-radius: .4rem;
        }

        .google-login-btn img {
            width: 20px;
            height: 20px;
            background: #ffffff;
        }
        .back-to-home{
            display: none;
        }
    @media (max-width: 600px) {
        .sign-up-link {
            display: flex;
            align-items: center;
            flex-direction: column;
            width: max-content;
            gap: 1rem;
        }
                .back-to-home{
            display: block;
        }
    }
    </style>
</body>

</html>
