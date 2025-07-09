@props(['gallery'])
<div class="gallery-main-div-card-body-image-card">
    <a href="{{ route('home.galleries.show', ['gallery' => $gallery->id . '-' . $gallery->name]) }}"></a>
    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}">
    <div class="gallery-main-div-card-body-image-card-info">
        <h3>{{ $gallery->name }}</h3>
        <p>View {{ $gallery->description }}</p>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .gallery-main-div-card-body-image-card {
        flex: 1;
        height: 430px;
        min-height: 430px;
        max-height: 430px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
    }

    .gallery-main-div-card-body-image-card a {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .gallery-main-div-card-body-image-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .gallery-main-div-card-body-image-card:hover .gallery-main-div-card-body-image-card-info {
        bottom: 0;
    }

    .gallery-main-div-card-body-image-card-info {
        width: 100%;
        position: absolute;
        bottom: -130px;
        left: 0;
        padding: 2rem;
        background: linear-gradient(180deg, #26272700, #1f1f1fcb);
        transition: 0.6s ease-in-out;
    }

    .gallery-main-div-card-body-image-card-info h3 {
        font-size: 18px;
        font-family: "Playfair Display", serif;
        font-style: italic;
        font-weight: 400;
        color: #ffffff;
        z-index: 2;
    }

    .gallery-main-div-card-body-image-card-info p {
        font-size: 14px;
        font-family: "Playfair Display", serif;
        font-style: italic;
        color: #ffffff;
        text-decoration: none;
        z-index: 2;
    }

    @media (max-width: 600px) {
        .gallery-main-div-card-body-image-card {
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
