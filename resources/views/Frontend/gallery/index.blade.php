@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Photos" />
    <section class="gallery-main-div">
        <div class="gallery-main-div-card">
            <div class="gallery-main-div-card-body">
                @forelse ($galleries as $gallery)
                    <x-gallary-card :gallery="$gallery" link="{{ route('home.galleries.show', ['gallery' => $gallery->id . '-' . $gallery->name]) }}" />
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <x-main-heading title="Videos" />
    <section class="gallery-main-div">
        <div class="gallery-main-div-card">
            <div class="gallery-main-div-card-body">
                @forelse ($videos as $video)
                    <x-video-card :video="$video" type="gallery" />
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <style>
        .gallery-main-div {
            width: 100%;
            height: auto;
            min-height: 100vh;
        }

        .gallery-main-div-card-body {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 1rem;
        }

        @media (max-width: 1200px) {
            .gallery-main-div-card-body {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .gallery-main-div-card-body {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .gallery-main-div-card-body {
                grid-template-columns: repeat(1, 1fr);
                gap: .5rem;
                padding: 1.5rem;
            }

            .gallery-main-div-card-body-image-card {
                flex: 1;
                width: auto;
                min-width: auto;
                max-width: auto;
                height: auto;
                min-height: 200px;
                max-height: auto;
                overflow: hidden;
                cursor: pointer;
                position: relative;
            }
            .gallery-main-div-card-body-image-card-info {
                width: 100%;
                position: absolute;
                bottom: -70px;
                left: -12px;
                padding: 2rem;
                background: linear-gradient(180deg, #26272700, #1f1f1fcb);
                transition: 0.6s ease-in-out;
            }

        }
    </style>
@endsection
