@extends('pages.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/business.css') }}">
@endsection

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <br>
        @if ($data->images->count() > 0)
            <div class="productsContent">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>Image Name</td>
                            <td>Image</td>
                            <td>Status</td>
                            <td>Edit</td>
                            <td>Delete</td>
                            <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->images as $image)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $image->image_name }}</td>
                                <td>
                                    <img class="blogLogo" src="{{ asset($image->image) }}" alt="">
                                </td>
                                <td>{{ $image->status }}</td>
                                <td>                    
                                    <a href="{{ route('business.manage.image.edit', ['id' => $image->id]) }}">
                                        <button class="addReview add">
                                            <span>Edit</span>
                                            <ion-icon name="create-outline"></ion-icon>
                                        </button>
                                    </a>
                                </td>
                                <td>                    
                                    <form action="{{ route('business.manage.image.delete', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
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
            <p>No images found.</p>
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
