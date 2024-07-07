@extends('pages.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('./css/business.css') }}">
@endsection

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span class="segment">{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="companyContainer">
            @if ($data->images)
                <div class="carousel">
                    <div class="carousel-inner">
                        @foreach($data->images as $image)
                        <div class="carousel-item active">
                            <img src="{{ asset($image->image) }}" style="max-width: 100%; max-height: 300px; margin-top: 10px;" alt="{{ $data->name }}">
                        </div>
                        @endforeach
                    </div>
                    <div class="carousel-controls">
                        <button class="carousel-control-prev">‹</button>
                        <button class="carousel-control-next">›</button>
                    </div>
                </div>
            @endif
            <div class="companyHeading">
                <h3 class="companyTitle">{{ $data->blog_title }}</h3>
                <div class="companyHeadingButtons">
                    <a href="{{ route('blog.edit', ['id' => $data->id]) }}">
                        <button class="addReview add">
                            <span>Edit</span>
                            <ion-icon name="create-outline"></ion-icon>
                        </button>
                    </a>
                    <a href="{{ route('blog.image.create', ['id' => $data->id]) }}">
                        <button class="addReview add">
                            <span>Add Image</span>
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </button>
                    </a>
                     @if ($data->images->count() > 0)
                        <a href="{{ route('blog.manage.image', ['id' => $data->id]) }}">
                            <button class="addReview add">
                                <span>Manage Image</span>
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </button>
                        </a>
                    @endif
                    <form action="{{ route('blog.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                        @csrf
                        @method('DELETE')
                        <button class="addReview add delete">
                            <span>Delete</span>
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
                </div>
            </div>
            <div class="companyContent">
                <h3 class="companyTitle">{{ $data->publish_date }}</h3>
                <div class="companyText">{!! $data->blog_text !!}</div>
            </div>
        </div>
    </main>
@endsection
@section("carouselScript")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prevButton = document.querySelector('.carousel-control-prev');
            const nextButton = document.querySelector('.carousel-control-next');
            const carouselInner = document.querySelector('.carousel-inner');
            const items = document.querySelectorAll('.carousel-item');
            let currentIndex = 0;

            function updateCarousel() {
                carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            prevButton.addEventListener('click', function () {
                currentIndex = (currentIndex === 0) ? items.length - 1 : currentIndex - 1;
                updateCarousel();
            });

            nextButton.addEventListener('click', function () {
                currentIndex = (currentIndex === items.length - 1) ? 0 : currentIndex + 1;
                updateCarousel();
            });
        });
    </script>
@endsection