@extends('pages.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('./css/business.css') }}">
@endsection

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
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
        <div class="carousel">
            <div class="carousel-inner">
                @foreach($carousels as $image)
                <div class="carousel-item active">
                    <img src="{{ asset($image->carousel_Image) }}" style="max-width: 100%; max-height: 300px; margin-top: 10px;" >
                </div>
                @endforeach
            </div>
            <div class="carousel-controls">
                <button class="carousel-control-prev">‹</button>
                <button class="carousel-control-next">›</button>
            </div>
        </div>
        @if ($carousels->count() > 0)
            <div class="productsContent">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>Title</td>
                            <td>Image</td>
                            <td>Status</td>
                            <td>Edit</td>
                            <td>Delete</td>
                            <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carousels as $data)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>
                                    <a href="{{ route('product.detail', ['id' => $data->id]) }}" class="navigation_a_tag">
                                        {{ $data->carousel_title }}
                                    </a>
                                </td>
                                <td>
                                    <img class="companyLogo" src="{{ $data->carousel_Image }}" alt="">
                                </td>
                                <td>{{ $data->carousel_status }}</td>
                                <td>                    
                                    <a href="{{ route('carousel.edit', ['id' => $data->id]) }}">
                                        <button class="addReview add">
                                            <span>Edit</span>
                                            <ion-icon name="create-outline"></ion-icon>
                                        </button>
                                    </a>
                                </td>
                                <td>                    
                                    <form action="{{ route('carousel.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="addReview add delete">
                                            <span>Delete</span>
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                                <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <span class="empty_data">no data found</span>
        @endif
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