@extends('Frontend.layouts.main')

@section('content')
    <div class="services-index-div">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="card3-content-user-info">
            <div class="card3-content-user-info-sub">
                <img src="{{ url('foodiety.png') }}" alt="" class="card3-content-user-image">
                <div class="card3-content-user-info-user-details">
                    <h3>The Foodiety</h3>
                    <span>{{ $video->created_at->format('d M') }}</span>
                </div>
            </div>
            <div class="card3-content-user-info-sub">
                <a href="{{ route('ai-videos.download', $video) }}" class="btn btn-success download-btn">Free Download <img
                        src="{{ url('arrow.png') }}" alt=""></a>
                {{-- <img src="{{ asset('share.png') }}" alt="" class="card3-content-share"> --}}
            </div>
        </div>
        <div class="video-player-container">
            @if ($video->video_path)
                <video controls autoplay loop class="video-player">
                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            @endif
        </div>
        <div class="card-body">
            <h1 class="card-title">{{ $video->name }}</h1>
            @if ($video->description)
                <p class="card-text">{{ $video->description }}</p>
            @endif
        </div>
    </div>
@endsection
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');

    .services-index-div {
        width: 55%;
        margin: auto;
    }

    .card {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 1rem;
    }
    .card-body{
        width: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .card3-content-user-info {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 5;
        margin-bottom: 2rem;
    }

    .card3-content-user-info-sub {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card3-content-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 1.5px solid #ffde59;
        padding: .1rem;
    }

    .card3-content-user-info-user-details h3 {
        font-size: 16px;
        font-weight: 600;
        color: #5f5f5f;
        text-transform: uppercase;
        margin-bottom: 0;
        white-space: nowrap;
    }

    .card3-content-user-info-user-details span {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
        margin-top: .1rem;
        margin-bottom: 0;
        font-family: "Raleway", sans-serif;
    }

    .card3-content-share {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .download-btn {
        width: fit-content;
        white-space: nowrap;
        padding: .5rem 1rem;
        border: 1px solid #ddd;
        cursor: pointer;
        text-decoration: none;
        color: #5f5f5f;
        font-weight: 500;
        font-size: 16px;
        background: #54ca84;
        color: #ffffff;
        border: 0;
        outline: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        border-radius: .4rem;
        font-family: "Raleway", sans-serif;
    }

    .download-btn img {
        width: 20px;
        height: 20px;
    }

    .card img {
        height: 700px;
        margin: auto;
        object-fit: contain;
    }

    @media (max-width: 1200px) {
        .services-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .services-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .services-index-div {
            width: 100%;
            margin: auto;
        }
    }
</style>
<style>
    .video-player-container {
        position: relative;
        width: 430px;
        height: 750px;
        margin: 0 auto;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-player-container video {
        height: 100%;
        width: 430px;
        margin: auto;
        object-fit: contain;
    }

    .video-player {
        height: 100%;
        outline: none;
    }

    .video-thumbnail {
        position: relative;
        cursor: pointer;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
        overflow: hidden;
        z-index: 1000;
    }

    .video-thumbnail img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .play-icon {
        width: 28px;
        height: 28px;
        z-index: 1000;
    }

    .video-thumbnail:hover img {
        transform: scale(1.05);
    }

    .video-thumbnail:hover .play-icon {
        background: rgba(0, 0, 0, 0.8);
        transform: translate(-50%, -50%) scale(1.1);
    }

    @media (max-width: 768px) {
        .play-icon {
            width: 50px;
            height: 50px;
        }

        .play-icon img {
            width: 20px;
        }
    }
</style>

<script>
    // If using thumbnail fallback with click-to-play functionality
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.video-thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const container = this.closest('.video-player-container');
                const videoSrc =
                    "{{ $video->video_path ? asset('storage/' . $video->video_path) : '' }}";

                if (videoSrc) {
                    container.innerHTML = `
                        <video controls autoplay class="video-player">
                            <source src="${videoSrc}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                    `;
                }
            });
        });
    });
</script>
