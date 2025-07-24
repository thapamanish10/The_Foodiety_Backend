@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Our Story"/>
    <div class="about-artical-main-container">
        @foreach ($abouts as $about)
            <artical class="about-artical">
                <section class="about-articel-section about-article-section-img-div">
                    <div class="main-blog-detail-div-card-image">
                        @if ($about->images->count() > 0)
                            <div class="blog-carousel">
                                @foreach ($about->images as $image)
                                    <div class="carousel-slide">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $about->name }}">
                                    </div>
                                @endforeach
                                <!-- Clone first image for infinite effect -->
                                @if ($about->images->count() > 1)
                                    <div class="carousel-slide">
                                        <img src="{{ asset('storage/' . $about->images->first()->path) }}"
                                            alt="{{ $about->name }}">
                                    </div>
                                @endif
                            </div>
                            @if ($about->images->count() > 1)
                                <div class="carousel-controls">
                                    <button class="carousel-prev">&lt;</button>
                                    <button class="carousel-next">&gt;</button>
                                </div>
                            @endif
                             <div class="carousel-indicators">
                                @foreach ($about->images as $index => $image)
                                    <span class="indicator {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}"></span>
                                @endforeach
                            </div>
                        @else
                            <img src="{{ asset('images/default-blog.jpg') }}" alt="No image">
                        @endif
                    </div>
                    {{-- <img class="blogLogo" src="{{ asset('storage/' . $about->logo) }}" alt="Blog Image" width="40"> --}}
                </section>
                <section class="about-articel-section">
                    <h1>Welcome to {{ $about->name }}</h1>
                    <div>{!! $about->desc !!}</div>
                </section>
            </artical>
        @endforeach
        <x-heading title="Our Services" />
        @include('Frontend.services.home-service')
        <br>
        <br>
        <br>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .about-artical-main-container {
            max-width: 65%;
            margin: auto;
        }

        .about-artical {
            width: 100%;
            margin: 2rem auto;
            gap: 3rem;
            max-height: 450px;
            padding: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .about-artical .about-articel-section,
        .about-article-section-img-div {
            height: 100%;
            overflow: hidden;
        }

        .about-article-section-img-div img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .about-artical .about-articel-section .about-article-section-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .about-articel-section a {
            color: #ffd415;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            font-family: "Playfair Display", serif;
        }

        p{
            padding: 0;
            margin: 0;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: justify;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            color: #5f5f5f;
            text-align: justify;
            display: -webkit-box;
            overflow: hidden;
            position: relative;
            padding: .5rem 0;
            margin: 0;
        }

        strong {
            font-weight: bold;
            font-family: "Playfair Display", serif;
        }
        /* Carousel Styles */
        .main-blog-detail-div-card-image {
            width: 100%;
            height: 450px;
            position: relative;
            overflow: hidden;
            margin: 2rem 0;
        }

        .blog-carousel {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .carousel-slide {
            min-width: 100%;
            height: 100%;
            flex-shrink: 0;
            transition: transform 0.5s ease;
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 3;
            display: none;
        }

        .carousel-prev,
        .carousel-next {
            background: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .carousel-indicators {
            position: absolute;
            bottom: 18px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .indicator {
            width: 10px;
            height: 10px;
            border-radius: .4rem;
            background: rgba(255, 255, 255, 0.329);
            cursor: pointer;
        }

        .indicator.active {
            width: 25px;
            background: #ffde59;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all carousels on the page
            document.querySelectorAll('.blog-carousel').forEach(carousel => {
                const slides = Array.from(carousel.children);
                const totalSlides = slides.length - 1; // Subtract 1 for the cloned slide
                let currentIndex = 0;
                let interval;

                // Get indicators for this carousel
                const indicatorsContainer = carousel.parentElement.querySelector('.carousel-indicators');
                const indicators = indicatorsContainer ? indicatorsContainer.querySelectorAll('.indicator') : [];

                // Set initial active indicator
                if (indicators.length > 0) {
                    indicators[0].classList.add('active');
                }

                // Auto-scroll every 3 seconds (right to left)
                function startAutoScroll() {
                    interval = setInterval(() => {
                        goToNextSlide();
                    }, 3000);
                }
                startAutoScroll();

                function updateIndicators() {
                    indicators.forEach((indicator, index) => {
                        indicator.classList.toggle('active', index === currentIndex);
                    });
                }

                function goToNextSlide() {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    carousel.style.transition = 'transform 0.5s ease';
                    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                    updateIndicators();
                }

                function goToSlide(index) {
                    currentIndex = index;
                    carousel.style.transition = 'transform 0.5s ease';
                    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                    updateIndicators();
                }

                // Handle transition end
                carousel.addEventListener('transitionend', () => {
                    // If at the clone (last slide), instantly jump to the real first slide
                    if (currentIndex >= totalSlides) {
                        carousel.style.transition = 'none';
                        currentIndex = 0;
                        carousel.style.transform = 'translateX(0)';
                        updateIndicators();
                    }
                });

                // Indicator click handler
                if (indicators.length > 0) {
                    indicators.forEach(indicator => {
                        indicator.addEventListener('click', function() {
                            const index = parseInt(this.getAttribute('data-index'));
                            clearInterval(interval);
                            goToSlide(index);
                            startAutoScroll();
                        });
                    });
                }

                // Pause on hover
                carousel.addEventListener('mouseenter', () => clearInterval(interval));
                carousel.addEventListener('mouseleave', startAutoScroll);
            });
        });
    </script>
@endsection
