@foreach ($restaurants as $restaurant)
    <div class="restaurant-card">
        <a
            href="{{ route('home.restaurants.show', ['restaurant' => $restaurant->id . '-0-' . $restaurant->name]) }}"></a>
        <div class="restaurant-card-sub-card">
            <div class="restaurant-images-container">
                @php
                    $validImages = $restaurant->images->filter(fn($img) => $img->path);
                @endphp
                @if ($validImages->count() > 0)
                    <div class="restaurant-carousel">
                        <div class="carousel-track-container">
                            <div class="carousel-track">
                                @foreach ($restaurant->images as $key => $image)
                                    <div class="carousel-slide {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $restaurant->name }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/default-restaurant.jpg') }}'">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="carousel-prev">❮</button>
                        <button class="carousel-next">❯</button>

                        <div class="carousel-indicators">
                            @foreach ($restaurant->images as $key => $image)
                                <span class="indicator {{ $key === 0 ? 'active' : '' }}"
                                    data-slide-to="{{ $key }}"></span>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="single-image">
                        <img src="{{ $restaurant->logo ? asset('storage/' . $restaurant->logo) : asset('images/default-restaurant.jpg') }}"
                            alt="{{ $restaurant->name }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/default-restaurant.jpg') }}'">
                    </div>
                @endif
            </div>
            <div class="restaurant-card-content">
                <div class="restaurant-card-content-sub">
                    <div class="restaurant-card-content-user-info">
                        <img src="{{ url('foodiety.png') }}" alt="" class="restaurant-card-content-user-image">
                        <div class="restaurant-card-content-user-info-user-details">
                            <h3>The Foodiety</h3>
                            <span>{{ $restaurant->created_at->format('d M') }}</span>
                        </div>
                        <img src="{{ asset('share.png') }}" alt="" class="restaurant-card-content-share">
                    </div>
                    <h2 class="restaurant-card-heading">
                        {{ $restaurant->name }}
                    </h2>

                    <p class="restaurant-card-desc">
                        {!! Str::limit($restaurant->desc, 200) !!}
                    </p>
                </div>
                <div class="restaurant-card-info">
                    <div class="restaurant-card-info-sec">
                        <div class="restaurant-card-info-sub-sec">
                            <span>{{ $restaurant->views_count }} views</span>
                        </div>
                        <div class="restaurant-card-info-sub-sec">
                            <span>{{ $restaurant->comments_count }} comments</span>
                        </div>
                    </div>
                    <div class="restaurant-card-info-sec">
                        <form action="{{ route('restaurants.like', $restaurant) }}" method="POST" class="like-form">
                            @csrf
                            <button type="submit"
                                class="like-button {{ $restaurant->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                                <div class="restaurant-card-info-sub-sec">
                                    <span>{{ $restaurant->likes_count }}</span>
                                    <img src="{{ asset($restaurant->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                                        alt="Like">
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .restaurant-images-container {
        position: relative;
        width: 50%;
        overflow: hidden;
        height: 370px;
    }

    .restaurant-carousel {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .carousel-track-container {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .carousel-track {
        display: flex;
        height: 100%;
        transition: transform 0.5s ease;
        width: 100%;
        /* Ensure full width */
    }

    .carousel-slide {
        min-width: 100%;
        height: 100%;
        flex-shrink: 0;
        /* Prevent slides from shrinking */
    }

    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        /* Remove any extra space below image */
    }

    /* Navigation Arrows */
    .carousel-prev,
    .carousel-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 10;
        font-size: 18px;
        display: none;
    }

    .carousel-prev {
        left: 15px;
    }

    .carousel-next {
        right: 15px;
    }

    /* Indicators */
    .carousel-indicators {
        position: absolute;
        bottom: 15px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 8px;
        z-index: 10;
    }

    .carousel-indicators .indicator {
        width: 12px;
        height: 12px;
        border-radius: .4rem;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: background 0.3s;
    }

    .carousel-indicators .indicator.active {
        width: 25px;
        background: rgb(253, 214, 40);
    }

    /* Fallback single image */
    .single-image {
        width: 100%;
        height: 100%;
    }

    .single-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    .restaurant-card-info-sec button {
        background: transparent;
        border: 0;
        outline: 0;
        cursor: pointer;
    }

    .restaurant-card {
        position: relative;
        width: 100%;
        margin: 0 auto 2rem;
        min-height: 370px;
        height: 370px;
        max-height: 370px;
        border: 1px solid #dddddd93;
        display: flex;
        align-items: stretch;
        overflow: hidden;
        background: white;
    }

    .restaurant-card {
        width: 100%;
        margin-bottom: 2rem;
    }

    .restaurant-card-sub-card {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .restaurant-card-sub-card:nth-child(odd) {
        flex-direction: row-reverse;
    }

    @media (max-width: 600px) {

        .restaurant-card-sub-card,
        .restaurant-card-sub-card:nth-child(odd) {
            flex-direction: column;
        }
    }

    .restaurant-card a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
    }

    .restaurant-card-card-image {
        width: 50%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .restaurant-card-content {
        height: 100%;
        width: 50%;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
    }

    .restaurant-card-content-sub {
        width: 90%;
        margin: auto;
    }

    .restaurant-card-info {
        width: 90%;
        margin: auto;
        padding: 1rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #dddddd93;
        z-index: 5;
        margin-top: auto;
    }

    .restaurant-card-content-user-info {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 5;
    }

    .restaurant-card-content-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 1.5px solid #ffde59;
        padding: .1rem;
    }

    .restaurant-card-content-user-info-user-details h3 {
        font-size: 16px;
        font-weight: 600;
        color: #5f5f5f;
        text-transform: uppercase;
        margin-bottom: 0;
        white-space: nowrap;
    }

    .restaurant-card-content-user-info-user-details span {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
        margin-top: .1rem;
        margin-bottom: 0;
        font-family: "Playfair Display", serif;
    }

    .restaurant-card-content-share {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .restaurant-card-heading {
        width: 100%;
        margin: 1rem 0;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        color: #5f5f5f;
        font-size: 1.5rem;
        line-height: 1.3;
    }

    ..restaurant-card-content-sub {
        height: 80%;
    }

    .restaurant-card-content-sub p {
        width: 100%;
        font-size: 15px;
        margin: 0.5rem 0;
        text-align: justify;
        color: #5f5f5f;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        max-height: calc(1.5em * 3);
        position: relative;
        flex-grow: 1;
    }

    .restaurant-card-desc::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.5em;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0), white 90%);
    }



    .restaurant-card-info-sec {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .restaurant-card-info-sub-sec {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .restaurant-card-info-sub-sec img {
        width: 18px;
        height: 18px;
        object-fit: cover;
    }

    .restaurant-card-info-sub-sec span {
        font-size: 15px;
        font-weight: normal;
        color: #5f5f5f;
    }

    .restaurant-card-info-sec form {
        margin: 0%;
    }

    /* Like Button Styles */
    .like-button {
        transition: all 0.2s ease;
    }

    .like-button:hover img {
        transform: scale(1.1);
    }

    .like-button.liked img {
        animation: heartBeat 0.5s;
    }

    @keyframes heartBeat {
        0% {
            transform: scale(1);
        }

        25% {
            transform: scale(1.2);
        }

        50% {
            transform: scale(1);
        }

        75% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Mobile Styles */
    /* @media (max-width: 600px) {
        .restaurant-card {
            position: relative;
            width: 100%;
            margin: 0 auto 2rem;
            min-height: 520px;
            height: 520px;
            max-height: 520px;
            border: 1px solid #dddddd93;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            overflow: hidden;
            background: white;
        }

        .restaurant-card-content-user-info {
            width: 95%;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            z-index: 5;
        }

        .restaurant-card-content-user-info-user-details h3 {
            font-size: 16px;
            font-weight: 600;
            color: #5f5f5f;
            text-transform: uppercase;
            margin-bottom: 0;
            margin-top: 0rem;
        }

        .restaurant-card-content-user-info-user-details p {
            font-size: 12px;
            font-weight: 500;
            color: #5f5f5f;
            margin-top: .3rem;
            margin-bottom: 0;
        }

        .restaurant-card-card-image {
            width: 50%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .restaurant-card-content {
            height: 50%;
            padding: .5rem;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .restaurant-card-heading {
            width: 95%;
            margin: 1rem auto;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            color: #5f5f5f;
            font-size: 1.5rem;
            line-height: 1.3;
        }

        .restaurant-card-content-sub {
            height: 80%;
        }

        .restaurant-card-content-sub p {
            width: 95%;
            margin: 0.5rem auto;
            font-size: 15px;
            text-align: justify;
            color: #5f5f5f;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
            max-height: calc(1.5em * 2);
            position: relative;
            flex-grow: 1;
        }

        .restaurant-card-info {
            height: 20%;
            width: 95%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #dddddd93;
            z-index: 5;
            margin-top: auto;
        }
    } */
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all carousels on the page
        document.querySelectorAll('.restaurant-carousel').forEach(carousel => {
            const slides = carousel.querySelectorAll('.carousel-slide');
            const prevBtn = carousel.querySelector('.carousel-prev');
            const nextBtn = carousel.querySelector('.carousel-next');
            const indicators = carousel.querySelectorAll('.indicator');
            let currentIndex = 0;
            let autoSlideInterval;

            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => {
                    slide.classList.remove('active');
                });

                // Update indicators
                indicators.forEach(indicator => {
                    indicator.classList.remove('active');
                });

                // Show current slide and update indicator
                slides[index].classList.add('active');
                indicators[index].classList.add('active');

                currentIndex = index;
            }

            function nextSlide() {
                const newIndex = (currentIndex + 1) % slides.length;
                showSlide(newIndex);
            }

            function prevSlide() {
                const newIndex = (currentIndex - 1 + slides.length) % slides.length;
                showSlide(newIndex);
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Event listeners
            nextBtn.addEventListener('click', () => {
                nextSlide();
                stopAutoSlide();
                startAutoSlide();
            });

            prevBtn.addEventListener('click', () => {
                prevSlide();
                stopAutoSlide();
                startAutoSlide();
            });

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    showSlide(index);
                    stopAutoSlide();
                    startAutoSlide();
                });
            });

            // Start auto-sliding
            startAutoSlide();

            // Pause on hover
            carousel.addEventListener('mouseenter', stopAutoSlide);
            carousel.addEventListener('mouseleave', startAutoSlide);

            // Show first slide initially
            showSlide(0);
        });
    });
</script>
