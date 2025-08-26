@props(['restaurant', 'views', 'comments', 'likes', 'query' => null])

<div class="restaurant-card">
    {{-- <a href="{{ route('home.restaurants.show', ['restaurant' => $restaurant->id . '-0-' . $restaurant->name]) }}"></a> --}}
    <div class="restaurant-card-sub-card">
        <!-- Image Carousel -->
        <div class="restaurant-card-card-image">
            @php
    $validImages = $restaurant->images->filter(fn($img) => !empty($img->path) && file_exists(public_path('storage/' . $img->path)));
@endphp
            @if ($validImages->isNotEmpty())
                <div class="image-carousel">
                    @foreach ($restaurant->images as $image)
                        <div class="carousel-slide">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $restaurant->name }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/default-restaurant.jpg') }}'"
                                data-debug-path="{{ $image->path }}">
                        </div>
                    @endforeach
                </div>
                <!-- Carousel navigation arrows -->
                <button class="carousel-prev">&lt;</button>
                <button class="carousel-next">&gt;</button>
                <!-- Carousel indicators -->
                <div class="carousel-indicators">
                    @foreach ($restaurant->images as $index => $image)
                        <span class="indicator {{ $index === 0 ? 'active' : '' }}"
                            data-index="{{ $index }}"></span>
                    @endforeach
                </div>
            @else
                <div class="no-image">
                    <img src="{{ asset('images/default-restaurant.jpg') }}" alt="No image available"
                        data-debug="no-images">
                </div>
            @endif
        </div>
        <div class="restaurant-card-content">
            <div class="restaurant-card-content-sub">
                <x-user-info/>
                <h2 class="restaurant-card-heading">
                    @if ($query)
                        {!! Str::highlight($restaurant->name, $query) !!}
                    @else
                        {{ $restaurant->name }}
                    @endif
                </h2>

                <p class="restaurant-card-desc">
                    @if ($query)
                        {!! Str::highlight(Str::limit($restaurant->desc, 200), $query) !!}
                    @else
                        {!! Str::limit($restaurant->desc, 200) !!}
                    @endif
                </p>
            </div>
            <div class="restaurant-card-info">
                <div class="restaurant-card-info-sec">
                    <div class="restaurant-card-info-sub-sec">
                        <span>{{ $views ?? '0' }} views</span>
                    </div>
                    <div class="restaurant-card-info-sub-sec">
                        <span>{{ $comments ?? '0' }} comments</span>
                    </div>
                </div>
                <div class="restaurant-card-info-sec">
                    <form action="{{ route('restaurants.like', $restaurant) }}" method="POST" class="like-form">
                        @csrf
                        <button type="submit"
                            class="like-button {{ $restaurant->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                            <div class="restaurant-card-info-sub-sec">
                                <span>{{ $likes ?? '0' }}</span>
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
<style>
    .restaurant-card-card-image {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .image-carousel {
        height: 100%;
        width: 100%;
        display: flex;
        transition: transform 0.5s ease;
    }

    .carousel-slide {
        height: 100%;
        min-width: 100%;
        box-sizing: border-box;
    }

    .carousel-slide img {
        height: 100%;
        width: 100%;
        display: block;
        object-fit: cover;
    }

    .carousel-prev,
    .carousel-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 10;
        display: none;
    }

    .carousel-prev {
        left: 10px;
    }

    .carousel-next {
        right: 10px;
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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

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
        z-index: 2;
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
    .restaurant-card-content-sub{
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
    
    .restaurant-card-heading {
        width: 100%;
        margin: 1rem 0;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        color: #5f5f5f;
        font-size: 1.5rem;
        line-height: 1.3;
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
    @media (max-width: 600px) {
       .restaurant-card{
            position: relative;
            width: 100%;
            margin: 0 auto 2rem;
            min-height: 600px;
            height: 600px;
            max-height: 600px;
            border: 1px solid #dddddd93;
            display: flex;
            align-items: stretch;
            overflow: hidden;
            background: white;
        }
        .restaurant-card-card-image {
            width: 100%;
            height: 40%;
            position: relative;
            overflow: hidden;
        }
        .restaurant-card-content {
            width: 100%;
            height: 60%;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
}
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousels = document.querySelectorAll('.image-carousel');

        carousels.forEach(carousel => {
            const slides = carousel.querySelectorAll('.carousel-slide');
            const prevBtn = carousel.parentElement.querySelector('.carousel-prev');
            const nextBtn = carousel.parentElement.querySelector('.carousel-next');
            const indicators = carousel.parentElement.querySelectorAll('.indicator');

            let currentIndex = 0;
            const totalSlides = slides.length;

            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;

                // Update indicators
                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.add('active');
                    } else {
                        indicator.classList.remove('active');
                    }
                });
            }

            // Next slide
            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel();
            });

            // Previous slide
            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateCarousel();
            });

            // Indicator click
            indicators.forEach(indicator => {
                indicator.addEventListener('click', () => {
                    currentIndex = parseInt(indicator.dataset.index);
                    updateCarousel();
                });
            });

            // Auto-rotate (optional)
            let interval = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel();
            }, 5000);

            // Pause on hover
            carousel.parentElement.addEventListener('mouseenter', () => {
                clearInterval(interval);
            });

            carousel.parentElement.addEventListener('mouseleave', () => {
                interval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    updateCarousel();
                }, 5000);
            });
        });
    });
</script>
