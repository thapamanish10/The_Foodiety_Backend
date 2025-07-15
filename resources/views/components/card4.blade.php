{{-- resources/views/components/card4.blade.php --}}
@props(['restaurant'])

@php
    // keep only images with a real file
    $validImages = $restaurant->images->filter(
        fn($img) => !empty($img->path) && file_exists(public_path('storage/' . $img->path)),
    );
@endphp

<div class="card4">
    <a href="{{ route('home.restaurants.show', ['restaurant' => $restaurant->id . '-0-' . $restaurant->name]) }}"></a>
    <!-- ─── Image area ────────────────────────────────────────────── -->
    @if ($validImages->count())
        <div class="card4-carousel">
            <div class="card4-track">
                @foreach ($validImages as $image)
                    <div class="card4-slide">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $restaurant->name }}"
                            onerror="this.onerror=null;this.closest('.card4-slide').remove();">
                    </div>
                @endforeach
            </div>

            <button class="card4-prev">❮</button>
            <button class="card4-next">❯</button>

            <div class="card4-indicators">
                @foreach ($validImages as $i => $img)
                    <span class="card4-indicator {{ $i === 0 ? 'active' : '' }}"
                        data-index="{{ $i }}"></span>
                @endforeach
            </div>
        </div>
    @endif
    <!-- ─── Text / meta area (customise as you like) ──────────────── -->
    <div class="card4-body">
        <div class="card4-content-sub">
            <div class="card4-content-user-info">
                <img src="{{ url('foodiety.png') }}" alt="" class="card4-content-user-image">
                <div class="card4-content-user-info-user-details">
                    <h3>The Foodiety</h3>
                    <span>{{ $restaurant->created_at->format('d M') }}</span>
                </div>
                <img src="{{ asset('share.png') }}" alt="" class="card4-content-share">
            </div>
            <h2 class="card4-heading">
                {{ $restaurant->name }}
            </h2>

            <p class="card4-desc">
                {!! Str::limit($restaurant->desc, 200) !!}
            </p>
        </div>
        <div class="card4-info">
            <div class="card4-info-sec">
                <div class="card4-info-sub-sec">
                    <span>{{ $restaurant->views->count() ?? '0' }} views</span>
                </div>
                <div class="card4-info-sub-sec">
                    <span>{{ $restaurant->comments->count() ?? '0' }} comments</span>
                </div>
            </div>
            <div class="card4-info-sec">
                <form action="{{ route('restaurants.like', $restaurant) }}" method="POST" class="like-form">
                    @csrf
                    <button type="submit"
                        class="like-button {{ $restaurant->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                        <div class="card4-info-sub-sec">
                            <span>{{ $restaurant->likes->count() ?? '0' }}</span>
                            <img src="{{ asset($restaurant->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                                alt="Like">
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- ──────────────────────────────────────────────────────────────────
     STYLES (loaded once, even if 100 cards appear on the page)
────────────────────────────────────────────────────────────────── --}}
@once
    @push('styles')
        <style>
            .card4-info-sec button {
                background: transparent;
                border: 0;
                outline: 0;
                cursor: pointer;
            }

            .card4 {
                width: 100%;
                height: 340px;
                border: 1px solid #e5e5e5;
                background: #fff;
                overflow: hidden;
                display: flex;
                margin-bottom: 1rem;
                position: relative;
            }

            .card4 a {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10000;
            }

            .card4:nth-child(even) {
                flex-direction: row-reverse;
            }

            .card4-image-wrapper {
                width: 100%;
                position: relative;
                height: 340px;
            }

            .card4-carousel {
                height: 340px;
                width: 50%;
                position: relative;
            }

            .card4-track {
                width: 100%;
                height: 100%;
                display: flex;
                transition: transform .6s ease-in-out;
            }

            .card4-slide {
                width: 100%;
                flex-shrink: 0;
                height: 100%;
                gap: 1rem;
            }

            .card4-slide img,
            .card4-single {
                height: 100%;
                width: 100%;
                object-fit: cover
            }

            .card4-prev,
            .card4-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 34px;
                height: 34px;
                border-radius: 50%;
                background: rgba(0, 0, 0, .4);
                color: #fff;
                border: 0;
                cursor: pointer;
                z-index: 4;
                display: none;
            }

            .card4-prev {
                left: 10px
            }

            .card4-next {
                right: 10px
            }

            .card4-indicators {
                position: absolute;
                bottom: 21px;
                left: 0;
                right: 0;
                display: flex;
                justify-content: center;
                gap: 6px;
                z-index: 4;
            }

            .card4-indicator {
                width: 10px;
                height: 10px;
                border-radius: 3px;
                background: #ffffff70;
                cursor: pointer
            }

            .card4-indicator.active {
                width: 24px;
                background: #ffde59
            }

            .card4-body {
                width: 50%;
                background: #ffffff;
                padding: 2rem 0 1rem 0;
                z-index: 1000;
            }

            .card4-content-sub {
                width: 90%;
                margin: auto;
            }

            .card4-info {
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

            .card4-content-user-info {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 1rem;
                position: relative;
                z-index: 5;
            }

            .card4-content-user-image {
                width: 45px;
                height: 45px;
                object-fit: cover;
                border-radius: 50%;
                border: 1.5px solid #ffde59;
                padding: .1rem;
            }

            .card4-content-user-info-user-details h3 {
                font-size: 16px;
                font-weight: 600;
                color: #5f5f5f;
                text-transform: uppercase;
                margin-bottom: 0;
                white-space: nowrap;
            }

            .card4-content-user-info-user-details span {
                font-size: 12px;
                font-weight: 500;
                color: #5f5f5f;
                margin-top: .1rem;
                margin-bottom: 0;
                font-family: "Playfair Display", serif;
            }

            .card4-content-share {
                position: absolute;
                top: 50%;
                right: 0;
                transform: translateY(-50%);
                width: 20px;
                height: 20px;
                cursor: pointer;
            }

            .card4-heading {
                width: 100%;
                margin: 1rem 0;
                font-family: "Playfair Display", serif;
                font-weight: 400;
                color: #5f5f5f;
                font-size: 1.5rem;
                line-height: 1.3;
            }

            .card4-content-sub {
                height: 80%;
            }

            .card4-content-sub p {
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

            .card4-desc::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 1.5em;
                background: linear-gradient(to bottom, rgba(255, 255, 255, 0), white 90%);
            }



            .card4-info-sec {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .card4-info-sub-sec {
                display: flex;
                align-items: center;
                gap: .5rem;
            }

            .card4-info-sub-sec img {
                width: 18px;
                height: 18px;
                object-fit: cover;
            }

            .card4-info-sub-sec span {
                font-size: 15px;
                font-weight: normal;
                color: #5f5f5f;
            }

            .card4-info-sec form {
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
        </style>
    @endpush

    {{-- ──────────────────────────────────────────────────────────────────
     SCRIPT (left‑to‑right, infinite, auto‑rotate, pause‑on‑hover)
────────────────────────────────────────────────────────────────── --}}
    @push('scripts')
        <script>
            (function() {
                if (window.__CARD4_LOADED__) return; // don’t load twice
                window.__CARD4_LOADED__ = true;

                document.addEventListener('DOMContentLoaded', () => {
                    document.querySelectorAll('.card4-carousel').forEach(initCarousel);
                });

                function initCarousel(wrapper) {
                    const track = wrapper.querySelector('.card4-track');
                    const slides = [...wrapper.querySelectorAll('.card4-slide')];
                    const prevBtn = wrapper.querySelector('.card4-prev');
                    const nextBtn = wrapper.querySelector('.card4-next');
                    const dots = [...wrapper.querySelectorAll('.card4-indicator')];

                    if (!slides.length) return;

                    /* start with the FIRST slide */
                    let index = 0;
                    goto(index);

                    const delay = 4000;
                    let timer = setInterval(next, delay); // auto‑move → right‑to‑left

                    /* helpers */
                    function goto(i) {
                        index = (i + slides.length) % slides.length;
                        track.style.transform = `translateX(-${index * 100}%)`;
                        dots.forEach((d, n) => d.classList.toggle('active', n === index));
                    }

                    function next() {
                        goto(index + 1);
                    } // right‑to‑left
                    function prev() {
                        goto(index - 1);
                    } // left‑to‑right
                    function reset() {
                        clearInterval(timer);
                        timer = setInterval(next, delay);
                    }

                    /* controls */
                    nextBtn?.addEventListener('click', () => {
                        next();
                        reset();
                    });
                    prevBtn?.addEventListener('click', () => {
                        prev();
                        reset();
                    });
                    dots.forEach((d, i) => d.addEventListener('click', () => {
                        goto(i);
                        reset();
                    }));

                    /* pause on hover */
                    wrapper.addEventListener('mouseenter', () => clearInterval(timer));
                    wrapper.addEventListener('mouseleave', reset);
                }
            })
            ();
        </script>
    @endpush
@endonce
