@extends('Frontend.layouts.main')

@section('content')
    <section class="main-blog-detail-div">
        <br>
        <br>
        <br>
        <x-main-sub-heading />
        <div class="main-blog-detail-div-card">
            <div class="main-blog-detail-div-user-info">
                <img src="https://images.pexels.com/photos/32645258/pexels-photo-32645258.jpeg" alt="User"
                    class="main-blog-detail-div-user-image">
                <div class="main-blog-detail-div-user-info-user-details">
                    <h3>The Foodiety</h3>
                    <p>{{ $blog->created_at->format('d M') }}</p>
                </div>
                <img src="{{ asset('share.png') }}" alt="Share" class="main-blog-detail-div-share">
            </div>
            <h2 class="main-blog-detail-div-heading">{{ $blog->name }}</h2>
            <p class="main-blog-detail-div-desc">
                {!! $blog->desc !!}
            </p>

            <!-- Image Carousel -->
            <div class="main-blog-detail-div-card-image">
                @if ($blog->images->count() > 0)
                    <div class="blog-carousel">
                        @foreach ($blog->images as $image)
                            <div class="carousel-slide">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $blog->name }}">
                            </div>
                        @endforeach
                        <!-- Clone first image for infinite effect -->
                        @if ($blog->images->count() > 1)
                            <div class="carousel-slide">
                                <img src="{{ asset('storage/' . $blog->images->first()->path) }}" alt="{{ $blog->name }}">
                            </div>
                        @endif
                    </div>
                    @if ($blog->images->count() > 1)
                        <div class="carousel-controls">
                            <button class="carousel-prev">&lt;</button>
                            <button class="carousel-next">&gt;</button>
                        </div>
                    @endif
                @else
                    <img src="{{ asset('images/default-blog.jpg') }}" alt="No image">
                @endif
            </div>
            <p class="main-blog-detail-div-desc">
                {!! $blog->desc2 !!}
            </p>
            <div class="main-blog-detail-div-info">
                <div class="main-blog-detail-div-info-sec">
                    <div class="main-blog-detail-div-info-sub-sec share-social-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank">
                            <img src="{{ asset('facebook-app-symbol.png') }}" alt="Share on Facebook">
                        </a>
                    </div>
                    <div class="main-blog-detail-div-info-sub-sec share-social-links">
                        <a href="https://twitter.com/intent/tweet?text=" target="_blank">
                            <img src="{{ asset('twitter (1).png') }}" alt="Share on Instagram">
                        </a>
                    </div>
                    <div class="main-blog-detail-div-info-sub-sec share-social-links"
                        onclick="copyToClipboard('{{ url()->current() }}')">
                        <img src="{{ asset('link.png') }}" alt="Copy link">
                    </div>
                </div>
            </div>

            <div class="main-blog-detail-div-info">
                <div class="main-blog-detail-div-info-sec">
                    <div class="main-blog-detail-div-info-sub-sec">
                        <span>{{ $viewCount }} views</span>
                    </div>
                    <div class="main-blog-detail-div-info-sub-sec">
                        <span>{{ $commentCount }} comments</span>
                    </div>
                </div>
                <div class="main-blog-detail-div-info-sec">
                    <form action="{{ route('blogs.like', $blog) }}" method="POST" class="like-form">
                        @csrf
                        <button type="submit" class="like-button {{ $blog->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                            <div class="main-blog-detail-div-info-sub-sec">
                                <span>{{ $likeCount }}</span>
                                <img src="{{ asset($blog->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                                    alt="Like">
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <x-add-comment :comments="$blog->comments" :blog_id="$blog->id" />
        <x-see-all-heading route="home.blogs.index" />
        @include('Frontend.blogs.recent')
    </section>
@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .main-blog-detail-div-info-sec button {
        background: transparent;
        border: 0;
        outline: 0;
    }



    .main-blog-detail-div {
        width: 55%;
        margin: auto;
        height: fit-content;
    }

    .main-blog-detail-div-card {
        padding: 3rem;
        border: 1px solid #ddd;
    }

    .main-blog-detail-div-user-info {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 5;
    }

    .main-blog-detail-div-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
    }

    .main-blog-detail-div-user-info-user-details {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .main-blog-detail-div-user-info-user-details h3 {
        font-size: 16px;
        font-weight: 600;
        white-space: nowrap;
        color: #5f5f5f;
        font-family: "Playfair Display", serif !important;
        text-transform: uppercase;
    }

    .main-blog-detail-div-user-info-user-details p {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
    }

    .main-blog-detail-div-share {
        position: absolute;
        top: 50%;
        right: 0%;
        transform: translate(0%, -50%);
        width: 20px;
        height: 20px;
    }

    .main-blog-detail-div-heading {
        width: 100%;
        font-size: 30px;
        margin: auto;
        padding: 1rem 0;
        font-family: "Playfair Display", serif !important;
        font-weight: 400;
        color: #5f5f5f;
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

    .main-blog-detail-div-card p {
        width: 100%;
        margin: auto;
        font-size: 17px;
        font-weight: 400;
        text-align: justify !important;
        color: #5f5f5f;
        line-height: 1.5;
    }

    .main-blog-detail-div-info {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1.5px solid #dddddd;
        z-index: 5;
    }

    .main-blog-detail-div-info-sec {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
    }

    .main-blog-detail-div-info-sub-sec {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .main-blog-detail-div-info-sub-sec img {
        width: 20px;
        height: 20px;
        object-fit: cover;
        cursor: pointer;
    }

    .main-blog-detail-div-info-sub-sec span {
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

    .share-social-links img {
        width: 18px;
        height: 18px;
    }

    .share-social-links a {
        display: flex;
    }

    @media (max-width: 768px) {
        .main-blog-detail-div {
            width: 100%;
            margin: auto;
            height: fit-content;
        }

        .main-blog-detail-div-card {
            padding: 1.5rem;
            border: 1px solid #ddd;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize infinite carousel
        const carousel = document.querySelector('.blog-carousel');
        if (carousel && carousel.children.length > 1) {
            const slides = carousel.children;
            const totalSlides = slides.length - 1; // Subtract 1 for the cloned slide
            let currentIndex = 0;
            let isTransitioning = false;

            // Set initial position
            carousel.style.transform = 'translateX(0)';

            // Auto-scroll every 3 seconds (right to left)
            const interval = setInterval(() => {
                if (!isTransitioning) {
                    goToNextSlide();
                }
            }, 3000);

            function goToNextSlide() {
                isTransitioning = true;
                currentIndex++;
                carousel.style.transition = 'transform 0.5s ease';
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            function goToPrevSlide() {
                isTransitioning = true;
                currentIndex--;
                carousel.style.transition = 'transform 0.5s ease';
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            // Handle transition end
            carousel.addEventListener('transitionend', () => {
                isTransitioning = false;

                // If at the clone (last slide), instantly jump to the real first slide
                if (currentIndex >= totalSlides) {
                    carousel.style.transition = 'none';
                    currentIndex = 0;
                    carousel.style.transform = 'translateX(0)';
                }
                // If at the first slide going backward, jump to the last real slide
                else if (currentIndex < 0) {
                    carousel.style.transition = 'none';
                    currentIndex = totalSlides - 1;
                    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                }
            });

            // Navigation buttons
            const prevBtn = document.querySelector('.carousel-prev');
            const nextBtn = document.querySelector('.carousel-next');

            if (prevBtn && nextBtn) {
                prevBtn.addEventListener('click', () => {
                    clearInterval(interval);
                    goToPrevSlide();
                });

                nextBtn.addEventListener('click', () => {
                    clearInterval(interval);
                    goToNextSlide();
                });
            }
        }

        // Copy link functionality
        window.copyToClipboard = function(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        };
    });
</script>
