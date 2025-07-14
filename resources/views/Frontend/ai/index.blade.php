@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="AI Photos" />
    <section class="gallery-main-div">
        <div class="gallery-main-div-card">
            <div class="gallery-main-div-card-body">
                @forelse ($ais as $ai)
                    <x-gallary-card :gallery="$ai"
                        link="{{ route('home.ais.show', ['ai' => $ai->id . '-' . $ai->name]) }}" />
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
                grid-template-columns: repeat(2, 1fr);
                gap: .5rem;
                padding: .5rem;
            }
        }
    </style>
@endsection
