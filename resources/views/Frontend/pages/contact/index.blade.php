<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .contact-article-main-section {
            width: 100%;
            background: #FFFCEE;
        }

        .contact-article {
            max-width: 65%;
            margin: 2rem auto;
            display: flex;
            gap: 3rem;
            max-height: 450px;
            padding: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
            padding: 2rem 0;
        }

        .contact-article-section h2 span {
            color: #5f5f5f;
            font-family: "Playfair Display", serif !important;
            text-transform: uppercase;
            background: #ffde59;
            padding: 0 .5rem;
        }

        .contact-article-section h2 {
            color: #5f5f5f;
            font-family: "Playfair Display", serif !important;
        }

        .contact-article .contact-article-section,
        .about-article-section-img-div {
            flex-basis: 50%;
            height: 100%;
            overflow: hidden;
        }

        .contact-article-section-form-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-article-section-form-group-row {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: space-between;
        }

        .contact-article-section-form-group-row input {
            width: 100%;
            height: 40px;
            padding: 7px 10px;
            border: 0;
            outline: 0;
            border: 1px solid #dddddd43;
            background: #ffffff;
            font-family: "Playfair Display", serif !important;
        }

        .contact-article-section-form-group-row input:focus,
        .contact-article-section-form-group textarea:focus {
            border-color: #ffde59;
        }

        .contact-article-section-form-group textarea {
            width: 100%;
            padding: 7px 10px;
            border: 0;
            outline: 0;
            border: 1px solid #dddddd43;
            background: #ffffff;
            font-family: "Playfair Display", serif !important;
        }

        .contact-article .contact-article-section .about-article-section-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .contact-article-section h2 {
            margin-bottom: 30px;
        }

        .contact-article-section p {
            font-size: 16px;
            margin-bottom: 20px;
            font-family: "Playfair Display", serif !important;
        }

        .contact-article-sub-section-card {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .contact-article-sub-section-card-section p {
            margin-left: 2.5rem;
        }

        .contact-article-sub-section-card-section-heading {
            display: flex;
            align-items: center;
            gap: .1rem;
        }

        .contact-article-sub-section-card-section-heading span {
            font-family: "Playfair Display", serif !important;
            font-weight: 500;
        }

        .contact-article-sub-section-card-section-heading img {
            width: 24px;
            margin-right: 1rem;
        }

        .contact-article-section-follow-us {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .contact-article-section-follow-us h3 {
            font-family: "Playfair Display", serif !important;
        }

        .contact-article-section-follow-us img {
            width: 24px;
            margin-right: 1rem;
            cursor: pointer;
        }

        .contact-article-section button {
            width: 100%;
            height: 40px;
            background: #ffde59;
            color: #0f172a;
            padding: 7px 10px;
            border: 0;
            outline: 0;
            font-family: "Playfair Display", serif !important;
        }

        @media (max-width: 1200px) {
            .contact-article {
                max-width: 100%;
                margin: 2rem auto;
                display: flex;
                flex-direction: column;
                gap: 3rem;
                max-height: fit-content;
                padding: 5px;
                overflow: hidden;
                transition: all 0.3s ease;
                padding: 2rem .5rem;
            }

            .contact-article-section h2 {
                margin-bottom: 30px;
                text-align: center;
            }

            .contact-article-section p {
                font-size: 16px;
                margin-bottom: 20px;
                font-family: "Playfair Display", serif !important;
                text-align: justify;
            }

            .contact-article-section-form-group textarea {
                width: 100%;
                padding: 7px 10px;
                border: 0;
                outline: 0;
                border: 1px solid #dddddd43;
                background: #ffffff;
                font-family: "Playfair Display", serif !important;
            }
        }
    </style>
    <section class="contact-article-main-section">
        <article class="contact-article">
            <section class="contact-article-section">
                <h2>Feel free to <span>contact</span> with <br> us for any kind of query.</h2>
                <p>Thank you for showing your interest in our Foodiety page. We consider communication with the customer
                    is
                    very
                    essential.</p>
                <div class="contact-article-sub-section-card">
                    <div class="contact-article-sub-section-card-section">
                        <div class="contact-article-sub-section-card-section-heading">
                            <img src="{{ url('email (2).png') }}" alt="">
                            <span>foodiety@gmail.com</span>
                        </div>
                    </div>
                    <div class="contact-article-sub-section-card-section">
                        <div class="contact-article-sub-section-card-section-heading">
                            <img src="{{ url('phone (2).png') }}" alt="">
                            <span>9815167893</span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="contact-article-section-follow-us">
                    <h3>Follow Us:</h3>
                    <img src="{{ url('facebook (2).png') }}" alt="Facebook">
                    <img src="{{ url('instagram (1).png') }}" alt="Instagram">
                    <img src="{{ url('youtube (1).png') }}" alt="Youtube">
                </div>
            </section>
            <section class="contact-article-section">
                <form action="">
                    <div class="contact-article-section-form-group">
                        <div class="contact-article-section-form-group-row">
                            <input type="text" placeholder="First name" autofocus>
                            <input type="text" placeholder="Last name">
                        </div>
                        <div class="contact-article-section-form-group-row">
                            <input type="text" placeholder="Email address">
                            <input type="text" placeholder="Phone number">
                        </div>
                        <textarea name="" id="" cols="10" rows="10"></textarea>
                        <button type="button">Send Message</button>
                    </div>
                </form>
            </section>
        </article>
    </section>
</body>

</html>
