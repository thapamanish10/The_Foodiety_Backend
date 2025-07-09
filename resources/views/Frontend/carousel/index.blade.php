<div class="hero-carousel">
    <div class="carousel-slide active"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
        <div class="carousel-content">
            <h1>Welcome to Hawksmoor</h1>
            <p>Exceptional steaks, seafood and cocktails in elegant surroundings.</p>
            <a href="#" class="carousel-btn">Book a Table</a>
        </div>
    </div>

    <div class="carousel-slide"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
        <div class="carousel-content">
            <h1>Sunday Roast</h1>
            <p>Join us for the finest Sunday roast in London, served with all the trimmings.</p>
            <a href="#" class="carousel-btn">View Menu</a>
        </div>
    </div>

    <div class="carousel-slide"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
        <div class="carousel-content">
            <h1>Private Dining</h1>
            <p>Host your next event in one of our elegant private dining rooms.</p>
            <a href="#" class="carousel-btn">Enquire Now</a>
        </div>
    </div>

    <div class="carousel-nav">
        <div class="carousel-dot active" onclick="currentSlide(0)"></div>
        <div class="carousel-dot" onclick="currentSlide(1)"></div>
        <div class="carousel-dot" onclick="currentSlide(2)"></div>
    </div>
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
@endpush
