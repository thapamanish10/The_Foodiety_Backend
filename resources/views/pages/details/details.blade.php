@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="totelItems">
            <h3>Total Items ()</h3>
            <a href="{{ route('carousel.create')}}">
                <button class="addReview add">
                    <span>Create Carousel</span>
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
            </a>
        </div>
        {{-- @if ($data->images) --}}
            <div class="carousel">
                <div class="carousel-inner">
                    {{-- @foreach($data->images as $image) --}}
                    <div class="carousel-item active">
                        {{-- <img src="{{ asset($image->image) }}" style="max-width: 100%; max-height: 300px; margin-top: 10px;" alt="{{ $data->name }}"> --}}
                    </div>
                    {{-- @endforeach --}}
                </div>
                <div class="carousel-controls">
                    <button class="carousel-control-prev">‹</button>
                    <button class="carousel-control-next">›</button>
                </div>
            </div>
        {{-- @else --}}
        <p>no data found</p>
        {{-- @endif --}}
    </main>
@endsection
