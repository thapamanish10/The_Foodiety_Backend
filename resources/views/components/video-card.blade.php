@props(['video'])
<div class="video-main-div-card-body-image-card">
    <a href="{{ route('home.videos.show', ['video' => $video->id . '-' . $video->name]) }}"></a>
    <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="{{ $video->name }}">
    <div class="video-main-div-card-body-image-card-info">
        <h3>{{ $video->name }}</h3>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .video-main-div-card-body-image-card {
        flex: 1;
        height: 650px;
        min-height: 650px;
        max-height: 650px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
    }

    .video-main-div-card-body-image-card a {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .video-main-div-card-body-image-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        background: linear-gradient(180deg, rgba(38, 39, 39, 0), rgba(31, 31, 31, 0.8));
        transition: transform 0.3s ease;
        display: block;
    }

    .video-main-div-card-body-image-card::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        backdrop-filter: blur(5px);
        border: 2px solid white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .video-main-div-card-body-image-card::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-40%, -50%);
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 25px solid white;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .video-main-div-card-body-image-card:hover img {
        transform: scale(1.05);
        backdrop-filter: blur(10px);
    }

    .video-main-div-card-body-image-card:hover::after,
    .video-main-div-card-body-image-card:hover::before {
        opacity: 1;
    }

    .video-main-div-card-body-image-card-info {
        width: 100%;
        top: 0%;
        left: 0%;
        position: absolute;
        padding: 3rem 0;
        transition: 0.6s ease-in-out;

    }

    .video-main-div-card-body-image-card-info h3 {
        font-size: 18px;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        color: #ffffff;
        z-index: 2;
        text-align: center;
        text-transform: uppercase;
    }

    .video-main-div-card-body-image-card-info p {
        font-size: 14px;
        font-family: "Playfair Display", serif;
        font-style: italic;
        color: #ffffff;
        text-decoration: none;
        z-index: 2;
    }

    @media (max-width: 600px) {
        .video-main-div-card-body-image-card {
            flex: 1;
            height: 200px;
            min-height: 200px;
            max-height: 200px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }
    }
</style>
