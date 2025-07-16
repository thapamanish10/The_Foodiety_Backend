@props(['blog', 'views', 'comments', 'likes', 'query' => null])

<div class="card2">
    <a href="{{ route('home.blogs.show', ['blog' => $blog->id . '-0-' . $blog->name]) }}"></a>

    <!-- Image Carousel -->
    <div class="card2-card-image">
        @if ($blog->images->isNotEmpty())
            @php
                $firstImage = $blog->images->first();
            @endphp
            <div class="single-image">
                <img src="{{ asset('storage/' . $firstImage->path) }}" alt="{{ $blog->name }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/default-blog.jpg') }}'"
                    data-debug-path="{{ $firstImage->path }}">
            </div>
        @else
            <div class="no-image">
                <img src="{{ asset('images/default-blog.jpg') }}" alt="No image available" data-debug="no-images">
            </div>
        @endif
    </div>

    <div class="card2-content">
        <div class="card2-content-sub">
            <x-user-info/>
            <h2 class="card2-heading">
                @if ($query)
                    {!! Str::highlight($blog->name, $query) !!}
                @else
                    {{ $blog->name }}
                @endif
            </h2>

            <p class="card2-desc">
                @if ($query)
                    {!! Str::highlight(Str::limit($blog->desc, 200), $query) !!}
                @else
                    {!! Str::limit($blog->desc, 200) !!}
                @endif
            </p>
        </div>
        <div class="card2-info">
            <div class="card2-info-sec">
                <div class="card2-info-sub-sec">
                    <span>{{ $views ?? '0' }} views</span>
                </div>
                <div class="card2-info-sub-sec">
                    <span>{{ $comments ?? '0' }} comments</span>
                </div>
            </div>
            <div class="card2-info-sec">
                <form action="{{ route('blogs.like', $blog) }}" method="POST" class="like-form">
                    @csrf
                    <button type="submit" class="like-button {{ $blog->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                        <div class="card2-info-sub-sec">
                            <span>{{ $likes ?? '0' }}</span>
                            <img src="{{ asset($blog->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                                alt="Like">
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    /* Base Styles */
    .card2-info-sec button {
        background: transparent;
        border: 0;
        outline: 0;
        cursor: pointer;
    }

    .card2 {
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

    .card2 a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
    }

    /* Image Carousel Styles */
    .card2-card-image {
        width: 50%;
        position: relative;
        height: 100%;
        overflow: hidden;
    }

    .single-image img,
    .no-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Content Area Styles */
    .card2-content {
        width: 50%;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        padding: 1rem;
    }
    .card2-content-sub {
        width: 90%;
        margin: auto;
    }

    .card2-info {
        width: 90%;
        margin: 1rem auto 0;
        padding: 1rem 0;
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #dddddd93;
        z-index: 5;
        margin-top: auto;
    }

    .card2-content-sub p {
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

    .card2-content-user-info {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 5;
    }

    .card2-content-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 1.5px solid #ffde59;
        padding: .1rem;
    }

    .card2-content-user-info-user-details h3 {
        font-size: 16px;
        font-weight: 600;
        color: #5f5f5f;
        text-transform: uppercase;
        margin-bottom: 0;
        white-space: nowrap;
    }

    .card2-content-user-info-user-details span {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
        margin-top: .1rem;
        margin-bottom: 0;
        font-family: "Playfair Display", serif;
    }

    .card2-content-share {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .card2-heading {
        width: 100%;
        margin: 1rem 0;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        color: #5f5f5f;
        font-size: 1.5rem;
        line-height: 1.3;
    }



    .card2-desc::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.5em;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0), white 90%);
    }

    /* Info Section Styles */

    .card2-info-sec {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card2-info-sub-sec {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .card2-info-sub-sec img {
        width: 18px;
        height: 18px;
        object-fit: cover;
    }

    .card2-info-sub-sec span {
        font-size: 15px;
        font-weight: normal;
        color: #5f5f5f;
    }

    .card2-info-sec form {
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
    @media (max-width: 768px) {
        .card2 {
            position: relative;
            width: 100%;
            margin: 0 auto 2rem;
            min-height: 530px;
            height: 530px;
            max-height: 530px;
            border: 1px solid #dddddd93;
            display: flex
        ;
        flex-direction: column;
            align-items: stretch;
            overflow: hidden;
            background: white;
        }
        .card2-card-image,
        .card2-content{
            width: 100%;
            padding: 0;
        }
    }
</style>
