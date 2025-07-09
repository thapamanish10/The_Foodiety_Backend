{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hawksmoor Restaurant</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap">
    <style>
        /* Hero Carousel */
        .hero-carousel {
            position: relative;
            height: 85vh;
            overflow: hidden;
        }

        .carousel-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
        }

        .carousel-content {
            position: absolute;
            bottom: 100px;
            left: 100px;
            color: white;
            max-width: 500px;
        }

        .carousel-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .carousel-content p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .carousel-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            text-decoration: none;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .carousel-btn:hover {
            background-color: white;
            color: #333;
        }

        .carousel-nav {
            position: absolute;
            bottom: 50px;
            right: 50%;
            display: flex;
            gap: 10px;
        }

        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: .25rem;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }

        .carousel-dot.active {
            width: 30px;
            background-color: white;
        }
    </style>
</head>

<body>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("carousel-slide");
            let dots = document.getElementsByClassName("carousel-dot");

            for (i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }

            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }

            for (i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }

            slides[slideIndex - 1].classList.add("active");
            dots[slideIndex - 1].classList.add("active");

            setTimeout(showSlides, 10000); // Change slide every 5 seconds
        }

        function currentSlide(n) {
            slideIndex = n;
            showSlides();
        }
    </script>
 --}}
@extends('Frontend.layouts.main')

@section('content')
@include('Frontend.carousel.index')
    @include('Frontend.pages.about.index')
    <div class="welcome-container-sections">
        <x-heading title="Recommended Picks" />
        @include('Frontend.recommended.index', ['restaurants' => $restaurants])
    </div>
    @include('Frontend.pages.contact.index')
    <div class="welcome-container-sections">
        <x-heading title="Blogs" />
        @include('Frontend.blogs.home-blog')
        <x-heading title="Recipes" />
        @include('Frontend.recipes.home-recipe')
    </div>
@endsection
<style>
    .welcome-container-sections{
        width:65%;
        margin: auto;
    }
    @media (max-width: 1200px) {
        .welcome-container-sections{
            width:65%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .welcome-container-sections{
            width:65%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .welcome-container-sections{
            width:100%;
            margin: auto;
            padding: 0.5rem;
        }
    }
</style>