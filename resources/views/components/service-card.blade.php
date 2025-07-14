<div class="service-card-main-container">
    <a href="{{ $link }}"></a>
    <div class="service-card-image">
        <img class="blogLogo" src="{{ asset('storage/' . $service->logo) }}" alt="Blog Image" width="40">
    </div>
    <div class="service-card-text">
        <h3>{{ $service->name }}</h3>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .service-card-main-container {
        width: 200px;
        height: 200px;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
        cursor: pointer;
        position: relative;
    }

    .service-card-text h3 {
        color: #ffffff;
        font-family: "Playfair Display", serif;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 15px;
        font-weight: 500;
    }

    .service-card-main-container a {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
    }

    .service-card-image {
        width: 108px;
        height: 108px;
        border: 1px solid #ffffff;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4rem;
        transition: transform 0.3s ease-out;
        transform-origin: center center;
        will-change: transform;
    }

    .service-card-image img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .service-card-image::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90px;
        height: 90px;
        border: 1px solid #ffffff;
        border-radius: 4rem;
        transition: all 0.3s ease-out;
    }

    .service-card-main-container:hover .service-card-image {
        transform: scale(1.1);
        transition: transform 0.3s ease-out;
    }
</style>
