<div class="hero-carousel">
    @foreach ($carousels as $index => $carousel)
        @if($carousel->carousel_Image) 
        <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
            <img class="companyLogo" src="{{ $carousel->carousel_Image }}" alt="">
        </div>
        @endif
    @endforeach
    <div class="carousel-nav">
        @foreach ($carousels as $index => $carousel)
            @if($carousel->carousel_Image) <!-- Only create dots for valid slides -->
            <div class="carousel-dot {{ $index === 0 ? 'active' : '' }}" onclick="currentSlide({{ $index }})"></div>
            @endif
        @endforeach
    </div>
    <style>
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

        @media (max-width: 768px) {
            .hero-carousel {
                position: relative;
                height: 25vh;
                overflow: hidden;
            }

            .carousel-nav {
                position: absolute;
                bottom: 20px !important;
                right: 43% !important;
                display: flex;
                gap: 10px;
            }
        }
        .carousel-slide.active {
            opacity: 1;
        }
        .carousel-slide img{
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            color: rgb(255, 255, 255);
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
            background-color: rgb(255, 217, 49);
        }
    </style>
</div>

@push('scripts')
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
            let slides = document.getElementsByClassName("carousel-slide");
            let dots = document.getElementsByClassName("carousel-dot");
            
            // If no slides available, return
            if (slides.length === 0) return;
            
            // Hide all slides
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }
            
            // Remove active from all dots
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }
            
            // Move to next slide
            slideIndex++;
            
            // If reached end, loop back to first slide
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            
            // Show current slide and activate corresponding dot
            slides[slideIndex - 1].classList.add("active");
            if (dots[slideIndex - 1]) {
                dots[slideIndex - 1].classList.add("active");
            }
            
            // Set timeout for next slide
            setTimeout(showSlides, 4000);
        }

        function currentSlide(n) {
            // Only change slide if the index is valid
            let slides = document.getElementsByClassName("carousel-slide");
            if (n >= 0 && n < slides.length) {
                slideIndex = n;
                showSlides();
            }
        }
    </script>
@endpush