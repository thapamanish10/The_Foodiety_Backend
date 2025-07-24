@php
    $services = App\Models\Service::orderBy('created_at', 'desc')->get();
@endphp
<div class="home-service-container">
    <img class="bg-image" src="{{ url('ww.jpg') }}" alt="">
    @foreach ($services as $service)
        <x-service-card :service="$service" type="clickable" :link="route('home.services.show', $service->id)" />
    @endforeach
</div>
<style>
    .home-service-container {
        width: 100%;
        margin: auto;
        height: fit-content;
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 15px;
        padding: 20px 0;
        position: relative;
        overflow: hidden;
    }

    .home-service-container .bg-image {
        background: linear-gradient(rgba(0, 0, 0, 0.644), rgba(0, 0, 0, 0.507));
        width: 100%;
        height: 100%;
        position: absolute;
        object-fit: cover;
    }

    /* @media (max-width: 1200px) {
        .home-service-container {
            grid-template-columns: repeat(3, 1fr);
        }
    } */

    @media (max-width: 900px) {
        .home-service-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .home-service-container {
            height: max-content;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
    }
</style>
