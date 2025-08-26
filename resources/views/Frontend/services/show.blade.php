@extends('Frontend.layouts.main')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .services-main-div {
            width: 55%;
            min-height: 100vh;
            height: max-content;
            margin: auto;
            margin-bottom: 2rem;
        }

        .services-main-div-section {
            width: 100%;
            height: 350px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            overflow: hidden;
            background: #dddddd38;
        }

        .services-main-sub-section-left {
            width: 35%;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
            padding: 2rem;
        }

        .services-main-sub-section-left h1 {
            font-size: 35px;
            font-weight: 600;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
            padding: 0;
            margin: 0;
        }

        .services-main-sub-section-left p {
            font-size: 15px;
            font-weight: 400;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
            padding: 0;
            margin: .1rem 0;
        }

        .services-main-sub-section-left a {
            font-size: 15px;
            font-weight: 400;
            padding: .5rem 1.5rem;
            border: 1px solid #ffd414;
            color: #5f5f5f;
            width: max-content;
            text-decoration: none;
            margin-top: 1rem;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
            transition: 0.3s ease-in;
        }

        .services-main-sub-section-left a:hover {
            background: #ffd414;
        }

        .services-main-sub-section-right {
            width: 50%;
            height: 100%;

        }

        .services-main-sub-section-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .why-website-section {
            width: 100%;
        }

        .why-website-section h3 {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            padding: 1rem 0;
            font-weight: 600;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .what-we-offer h3 {
            width: 100%;
            display: flex;
            align-items: flex-start !important;
            justify-content: flex-start;
            font-size: 25px;
            padding: 2rem 0;
            font-weight: 600;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .why-website-section p {
            font-size: 15px;
            font-weight: 400;
            text-align: justify;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .what-we-offer {
            width: 50%;
        }

        .what-we-offer p {
            font-size: 15px;
            font-weight: 400;
            text-align: justify;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .row {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
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

        @media (max-width: 600px) {
            .services-main-div{
                width: 90%;
                margin-top: 1rem;
            }
            .services-main-div-section {
                width: 100%;
                height: max-content;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                justify-content: space-between;
                gap: 1rem;
                overflow: hidden;
                background: #dddddd38;
            }
            .services-main-sub-section-right {
                width: 100%;
                height: 100%;
            }

            .services-main-sub-section-left {
                width: 100%;
                flex-direction: column;
                padding: 2rem 1rem;
            }
            .services-main-sub-section-left p {
                width: 90%;
                text-align: justify;
            }
            .main-blog-detail-div-card-image {
                width: 100%;
                height: 230px;
                position: relative;
                overflow: hidden;
                margin: 2rem 0;
            }
            .row {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            .what-we-offer {
                width: 100%;
            }
            .what-we-offer h3 {
                width: 100%;
                display: flex;
                align-items: flex-start !important;
                justify-content: flex-start;
                font-size: 25px;
                padding: 0 0;
                font-weight: 600;
                font-family: "Playfair Display", serif !important;
                color: #5f5f5f;
            }

        }
    </style>
    <x-main-heading title="Foodiety Services Details" />
    <section class="services-main-div">
        <div class="services-main-div-section">
            <div class="services-main-sub-section-left">
                <h1>{{ $service->title }}</h1>
                <p>{!! $service->info !!}</p>
                <a href="#contact" class="btn">Get Started</a>
            </div>
            <div class="services-main-sub-section-right">
                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="">
            </div>
        </div>
        <section class="why-website-section">
            <h3>Why {{ $service->name }}</h3>
            <p>{!! $service->why2 !!}
            </p>
        </section>
        <br>
        <div class="main-blog-detail-div-card-image">
            @if ($service->images->count() > 0)
                <div class="blog-carousel">
                    @foreach ($service->images as $image)
                        <div class="carousel-slide">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $service->name }}">
                        </div>
                    @endforeach
                    <!-- Clone first image for infinite effect -->
                    @if ($service->images->count() > 1)
                        <div class="carousel-slide">
                            <img src="{{ asset('storage/' . $service->images->first()->path) }}"
                                alt="{{ $service->name }}">
                        </div>
                    @endif
                </div>
                @if ($service->images->count() > 1)
                    <div class="carousel-controls">
                        <button class="carousel-prev">&lt;</button>
                        <button class="carousel-next">&gt;</button>
                    </div>
                @endif
                <div class="carousel-indicators">
                    @foreach ($service->images as $index => $image)
                        <span class="indicator {{ $index === 0 ? 'active' : '' }}"
                            data-index="{{ $index }}"></span>
                    @endforeach
                </div>
            @else
                <img src="{{ asset('images/default-blog.jpg') }}" alt="No image">
            @endif
        </div>
        <div class="row">
            <section class="what-we-offer">
                <h3>What we offer</h3>
                <p>{!! $service->offer !!}
                </p>
            </section>
            <section class="what-we-offer">
                <h3>Why us?</h3>
                <p>{!! $service->why !!}
                </p>
            </section>
        </div>
    </section>
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
