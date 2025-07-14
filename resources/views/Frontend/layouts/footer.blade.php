<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodiety Footer</title>
    <style>
        .footer {
            width: 100%;
            margin: 0 auto;
            background-color: #000000;
            padding: 30px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color: #fff
        }

        .footer-main-section {
            max-width: 75%;
            margin: auto;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 2rem;
        }

        .footer-section {
            flex-basis: 30%;
        }

        .footer-section img {
            width: 150px;
            border-radius: .2rem;

        }

        .intro-text {
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 25px;
            color: #fff;
        }

        .footer-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #fff;
        }

        .contact-info {
            margin-bottom: 25px;
        }

        .phone {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        .email {
            color: #ffde59;
            text-decoration: none;
        }

        .explore-links {
            margin-bottom: 25px;
        }

        .explore-links a {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            text-decoration: none;
        }

        .explore-links a:hover {
            color: #ffde59;
        }

        .divider {
            border: none;
            border-top: 1px solid #ddd;
            margin: 25px 0;
        }

        .copyright {
            text-align: center;
            font-size: 14px;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="footer">
        <div class="footer-main-section">
            <section class="footer-section">
                <img src="{{ url('/foodiety.png') }}" alt="">
                <p class="intro-text">
                    Step into the captivating world of our room, where every corner holds a new adventure waiting to be
                    discovered.
                </p>
            </section>
            <section class="footer-section">
                <div class="contact-info">
                    <h2>Contact Info</h2>
                    <span class="phone">+977 9812345678</span>
                    <a href="https://www.himalayafores.com" class="email">Himalayafores@gmail.com</a>
                </div>
            </section>
            <section class="footer-section">
                <div class="explore-links">
                    <h2>EXPLORE</h2>
                    <a href="#">Home</a>
                    <a href="#">Services</a>
                    <a href="#">Contact Us</a>
                    <a href="#">About Us</a>
                    <a href="#">Blog</a>
                </div>
            </section>
        </div>
        <div class="divider"></div>
        <div class="copyright">
            Copyright 2024 All Right Reserved by Foodiety
        </div>
    </div>
</body>

</html>
{{-- @push('scripts')
    <script>
        // Page-specific scripts
    </script>
@endpush --}}
