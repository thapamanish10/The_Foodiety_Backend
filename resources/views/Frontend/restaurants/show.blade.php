
@section('meta')
@if(isset($restaurant) && isset($shareLinks))
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@YourTwitterHandle">
    <meta name="twitter:title" content="{{ $restaurant->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($restaurant->desc), 100) }}">
    <meta name="twitter:image" content="{{ $shareLinks['image_url'] }}">
    <meta name="twitter:url" content="{{ url()->current() }}">
    
    <!-- Open Graph (also used by Twitter as fallback) -->
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $restaurant->name }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($restaurant->desc), 100) }}" />
    <meta property="og:image" content="{{ $shareLinks['image_url'] }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
@endif
@endsection
@extends('Frontend.layouts.main')

@section('content')
<section class="main-restaurant-detail-div">
    <br>
    <br>
    <br>
    <x-main-sub-heading />
    <div class="main-restaurant-detail-div-card">
          <x-user-info/>
        <div class="restaurant-header">
            <h1 class="restaurant-name">{{ $restaurant->name }}</h1>
        </div>
        <div class="restaurant-description">
            <p>{!!  $restaurant->desc !!}</p>
        </div>
        <!-- Image Carousel -->
        <div class="image-carousel">
            <div class="carousel-inner">
                @foreach ($restaurant->images as $image)
                <div class="carousel-slide">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $restaurant->name }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/default-restaurant.jpg') }}'"
                        data-debug-path="{{ $image->path }}" loading="lazy">
                </div>
                @endforeach
            </div>
            <button class="carousel-control carousel-prev">❮</button>
            <button class="carousel-control carousel-next">❯</button>
            <div class="carousel-indicators">
                @foreach ($restaurant->images as $index => $image)
                    <span class="indicator {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                @endforeach
            </div>
        </div>
        
        <!-- Description -->

        <div class="restaurant-description">
            <p>{!!  $restaurant->desc2!!}</p>
        </div>
        <div class="row">
            <div class="facilities-section">
                <h2 class="section-title">Most popular facilities</h2>
                <div class="facilities-grid">
                    <div class="facility-item">☺ Non-smoking rooms</div>
                    <div class="facility-item">☹ Bar</div>
                    <div class="facility-item">☺ Free WiFi</div>
                    <div class="facility-item">☺ Free parking</div>
                </div>
            </div>
            <div class="ratings-section">
                <h2 class="section-title">Ratings</h2>
                <div class="rating-overall">☆ {{ $restaurant->rating }}</div>
                <div class="rating-categories">
                    <div class="rating-category">
                        <span class="rating-category-name">Food</span>
                        <span class="rating-category-star">
                            @for ($i = 0; $i < $restaurant->food; $i++)
                                ★
                            @endfor
                        </span>
                    </div>
                    <div class="rating-category">
                        <span class="rating-category-name">Service</span>
                        <span class="rating-category-star">
                            @for ($i = 0; $i < $restaurant->services; $i++)
                                ★
                            @endfor
                        </span>
                    </div>
                    <div class="rating-category">
                        <span class="rating-category-name">Value</span>
                        <span class="rating-category-star">
                            @for ($i = 0; $i < $restaurant->value; $i++)
                                ★
                            @endfor
                        </span>
                    </div>
                    <div class="rating-category">
                        <span class="rating-category-name">Atmosphere</span>
                        <span class="rating-category-star">
                            @for ($i = 0; $i < $restaurant->atmosphere; $i++)
                                ★
                            @endfor
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="features-section">
                <h2 class="section-title">Features</h2>
                {{-- <div class="features-tags">
                    <span class="feature-tag">Takeout</span>
                    <span class="feature-tag">Reservations</span>
                    <span class="feature-tag">Outdoor Seating</span>
                    <span class="feature-tag">Seating</span>
                    <span class="feature-tag">Street Parking</span>
                    <span class="feature-tag">Free off-street parking</span>
                    <span class="feature-tag">Highchairs Available</span>
                    <span class="feature-tag">Wheelchair Accessible</span>
                    <span class="feature-tag">Serves Alcohol</span>
                    <span class="feature-tag">Full Bar</span>
                    <span class="feature-tag">Wine and Beer</span>
                    <span class="feature-tag">Accepts American Express</span>
                    <span class="feature-tag">Accepts Mastercard</span>
                    <span class="feature-tag">Accepts Visa</span>
                    <span class="feature-tag">Digital Payments</span>
                    <span class="feature-tag">Cash Only</span>
                    <span class="feature-tag">Free WiFi</span>
                    <span class="feature-tag">Accepts Credit Cards</span>
                    <span class="feature-tag">Table Service</span>
                    <span class="feature-tag">Live Music</span>
                    <span class="feature-tag">Jazz Bar</span>
                    <span class="feature-tag">Family style</span>
                    <span class="feature-tag">Sports bars</span>
                    <span class="feature-tag">Gift Cards Available</span>
                </div> --}}
            </div>
            <div class="location-section">
                <h2 class="section-title">Location And Contact</h2>
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                <div id="map" style="height: 400px; width: 100%;"></div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Your coordinates (replace with dynamic values from your backend)
                        const latitude = {{ $restaurant->latitude ?? '' }}; // Example: Kathmandu latitude
                        const longitude = {{ $restaurant->longitude ?? '' }}; // Example: Kathmandu longitude
                        
                        // Initialize the map
                        const map = L.map('map').setView([latitude, longitude], 15);
                        
                        // Add OpenStreetMap tiles
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                        
                        // Add a marker
                        const marker = L.marker([latitude, longitude]).addTo(map);
                        
                        // Add popup to marker
                        marker.bindPopup("<b>{{ $restaurant->name ?? 'Restaurant' }}</b>").openPopup();
                        
                        // Optional: Add a circle around the marker
                        L.circle([latitude, longitude], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.2,
                            radius: 200 // 200 meters radius
                        }).addTo(map);
                    });
                    </script>
                <div class="contact-info">
                    {{-- <div class="contact-item">📍 {{ $restaurant-> }}</div> --}}
                    <div class="contact-item"><img src="{{ url('call.png') }}" alt=""> {{ $restaurant->number }}</div>
                    <div class="contact-item"><img src="{{ url('gmail.png') }}" alt=""> {{ $restaurant->email }}</div>
                </div>
            </div>
        </div>
        <div class="main-restaurant-detail-div-info">
                <div class="main-restaurant-detail-div-info-sec">
                    <!-- Facebook -->
                    {{-- <div class="main-restaurant-detail-div-info-sub-sec share-social-links">
                        <a href="{{ $shareLinks['facebook'] ?? '#' }}" target="_blank">
                            <img src="{{ asset('facebook-app-symbol.png') }}" alt="Share on Facebook">
                        </a>
                    </div> --}}

                    <!-- Twitter -->
                    <div class="main-restaurant-detail-div-info-sub-sec share-social-links">
                        <a href="{{ $shareLinks['twitter'] ?? '#' }}" target="_blank">
                            <img src="{{ asset('tw.png') }}" alt="Share on Twitter">
                        </a>
                    </div>

                    <!-- WhatsApp (New) -->
                    <div class="main-restaurant-detail-div-info-sub-sec share-social-links">
                        <a href="{{ $shareLinks['whatsapp'] ?? '#' }}" target="_blank">
                            <img src="{{ asset('wa2.png') }}" alt="Share on WhatsApp">
                        </a>
                    </div>

                    <!-- Copy Link -->
                    <div class="main-restaurant-detail-div-info-sub-sec share-social-links" 
                        onclick="copyToClipboard('{{ $shareLinks['copy_link'] ?? '#' }}')">
                        <img src="{{ asset('link.png') }}" alt="Copy link">
                    </div>
                </div>
            </div>
        <div class="main-restaurant-detail-div-info">
            <div class="main-restaurant-detail-div-info-sec">
                <div class="main-restaurant-detail-div-info-sub-sec">
                    <span>{{ $viewCount }} views</span>
                </div>
                <div class="main-restaurant-detail-div-info-sub-sec">
                    <span>{{ $commentCount }} comments</span>
                </div>
            </div>
            <div class="main-restaurant-detail-div-info-sec">
                <form action="{{ route('restaurants.like', $restaurant) }}" method="POST" class="like-form">
                    @csrf
                    <button type="submit" class="like-button {{ $restaurant->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                        <div class="main-restaurant-detail-div-info-sub-sec">
                            <span>{{ $likeCount }}</span>
                            <img src="{{ asset($restaurant->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                                alt="Like">
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div >
    <x-add-comment :comments="$restaurant->comments" :blog_id="$restaurant->id" type="restaurant"/>
        <x-see-all-heading route="home.blogs.index" />
        @include('Frontend.blogs.recent')
</section >
@endsection

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
    .row{
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 2rem 0;
    }
    .main-restaurant-detail-div {
        width: 55%;
        margin: auto;
        height: fit-content;
   }
   .main-restaurant-detail-div-card {
        padding: 3rem;
        border: 1px solid #ddd;
    }
    
    /* Carousel Section */
    .image-carousel {
        position: relative;
        width: 100%;
        height: 450px;
        overflow: hidden;
        margin: 30px 0;
    }
    
    .carousel-inner {
        display: flex;
        transition: transform 0.5s ease;
        height: 100%;
    }
    
    .carousel-slide {
        min-width: 100%;
        height: 100%;
    }
    
    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .carousel-control {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        color: rgb(255, 255, 255);
        border: none;
        padding: 15px;
        cursor: pointer;
        z-index: 10;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        display: none;
    }
    
    .carousel-prev {
        left: 20px;
    }
    
    .carousel-next {
        right: 20px;
    }
    
    .carousel-indicators {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    
    .indicator {
        width: 10px;
        height: 10px;
        border-radius: .4rem;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: background 0.3s ease;
    }
    
    .indicator.active {
        width: 25px;
        background: rgb(255, 214, 31);
    }
    
    /* Description Section */
    .restaurant-description p {
        width: 100%;
        margin: auto;
        font-size: 17px;
        font-weight: 400;
        text-align: justify !important;
        color: #5f5f5f;
        line-height: 1.5;
    }
    /* Facilities Section */
    .facilities-section {
        margin-bottom: 30px;
    }
    
    .section-title {
        font-size: 18px;
        margin-bottom: 15px;
        color: #5f5f5f;
        padding-bottom: 8px;
        font-family: "Playfair Display", serif !important;
        border-bottom: 1px solid #ddd;
    }
    
    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }
    
    .facility-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Features Section */
    .features-section {
        margin-bottom: 30px;
    }
    
    .features-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .feature-tag {
        background: #f5f5f5;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-family: "Playfair Display", serif;
    }
    
    /* Ratings Section */
    .ratings-section {
        width: 50%;
        margin-bottom: 30px;
        border: 1px solid #ddd;
        padding: 1rem;
    }
    
    .rating-overall {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 15px;
    }
    
    .rating-categories {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(max-content, 1fr));
        gap: 15px;
    }
    
    .rating-category {
        display: flex;
        flex-direction: column;
    }
    
    .rating-category-name {
        font-weight: bold;
        margin-bottom: 5px;
        font-family: "Playfair Display", serif;
        color: #5f5f5f;
    }
    
    .rating-category-star {
        font-size: 20px;
        color: #f7c217;
    }
    
    /* Location Section */
    .location-section {
        width: 50%;
        margin-bottom: 30px;
        border: 1px solid #ddd;
        padding: 1rem;
    }
    
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 1rem 0 .5rem 0;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 5px;
        font-family: "Playfair Display", serif;
        color: #5f5f5f;
        font-size: 15px;
    }
    .contact-item img{
        width: 20px;
        height: 20px;
        object-fit: cover;
    }

    
    .main-restaurant-detail-div-info {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1.5px solid #dddddd;
        z-index: 5;

    }

    .main-restaurant-detail-div-info-sec {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
    }

    .main-restaurant-detail-div-info-sub-sec {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .main-restaurant-detail-div-info-sub-sec img {
        width: 20px;
        height: 20px;
        object-fit: cover;
        cursor: pointer;
    }

    .main-restaurant-detail-div-info-sub-sec span {
        font-size: 15px;
        font-weight: normal;
        color: #5f5f5f;
        
    }

    .share-social-links {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid #ddd;
        cursor: pointer;
    }

    .share-social-links img{
        width: 50%;
        height: 50%;
        margin: auto;
        object-fit: cover;
    }

    .share-social-links a {
        display: flex;
    }

    .main-restaurant-detail-div-info-sec button {
        background: transparent;
        border: 0;
        outline: 0;
    }

    @media (max-width: 768px) {
        .main-restaurant-detail-div {
            width: 100%;
            margin: auto;
            height: fit-content;
        }

        .main-restaurant-detail-div-card {
            padding: 1.5rem;
            border: 1px solid #ddd;
        }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .image-carousel {
            height: 300px;
        }
        
        .restaurant-name {
            font-size: 2rem;
        }
        
        .facilities-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }

</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.carousel-inner');
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        const indicators = document.querySelectorAll('.indicator');
        
        // Clone first and last slides for infinite effect
        const firstClone = slides[0].cloneNode(true);
        const lastClone = slides[slides.length - 1].cloneNode(true);
        
        carousel.appendChild(firstClone);
        carousel.insertBefore(lastClone, slides[0]);
        
        const allSlides = document.querySelectorAll('.carousel-slide');
        let currentIndex = 1; // Start at 1 because of the cloned slide
        const totalSlides = allSlides.length;
        
        // Set initial position
        carousel.style.transform = `translateX(-${100 * currentIndex}%)`;
        
        function updateCarousel() {
            carousel.style.transition = 'transform 0.5s ease';
            carousel.style.transform = `translateX(-${100 * currentIndex}%)`;
            
            // Update indicators (skip cloned slides)
            const realIndex = (currentIndex - 1 + slides.length) % slides.length;
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === realIndex);
            });
        }
        
        function handleTransitionEnd() {
            // If we're at the cloned first slide, jump to real last slide
            if (currentIndex === 0) {
                carousel.style.transition = 'none';
                currentIndex = slides.length;
                carousel.style.transform = `translateX(-${100 * currentIndex}%)`;
            }
            // If we're at the cloned last slide, jump to real first slide
            else if (currentIndex === totalSlides - 1) {
                carousel.style.transition = 'none';
                currentIndex = 1;
                carousel.style.transform = `translateX(-${100 * currentIndex}%)`;
            }
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
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index + 1; // +1 because of the cloned slide
                updateCarousel();
            });
        });
        
        // Auto-rotate
        let interval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        }, 5000);
        
        // Pause on hover
        const carouselContainer = document.querySelector('.image-carousel');
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(interval);
        });
        
        carouselContainer.addEventListener('mouseleave', () => {
            interval = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateCarousel();
            }, 5000);
        });
        
        // Handle infinite scroll effect
        carousel.addEventListener('transitionend', handleTransitionEnd);
    });
</script>

