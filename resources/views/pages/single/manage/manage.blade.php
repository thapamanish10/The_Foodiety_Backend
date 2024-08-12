@extends('pages.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/business.css') }}">
@endsection

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
            <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
            <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="photosHeading">
            <h3>Photos & Videos</h3>
            <a href="{{ route('product.image.create', ['id' => $data->id]) }}">
                <button class="btn btnEdit">
                    <span>Add Image</span>
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
            </a>
            <a href="{{ route('product.video.create', ['id' => $data->id]) }}">
                <button class="btn btnEdit">
                    <span>Add Videos</span>
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
            </a>
        </div>
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
                                <td style="display: flex; align-items:center; gap: 10px; border: none; outline: none; color: #ffde59">
                                    <img class="blogLogo" src="{{ asset($image->image) }}" alt="">
                                    <ion-icon name="image-outline"></ion-icon>
                                </td>
                                <td>{{ $image->status }}</td>
                                <td>                    
                                    <a href="{{ route('product.image.edit', ['id' => $image->id]) }}">
                                        <button class="btn btnEdit">
                                            <span>Edit</span>
                                            <img src="{{ asset('dashboardicons/edit.png') }}" alt="editIcon">
                                        </button>
                                    </a>
                                </td>
                                <td>                    
                                    <form action="{{ route('manage.image.delete', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btnDelete btnDanger">
                                            <span>Delete</span>
                                            <img src="{{ asset('dashboardicons/delete.png') }}" alt="DeleteIcon">
                                        </button>
                                    </form>
                                </td>
                                <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                            </tr>
                        @endforeach
                        @foreach ($data->videos as $video)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $video->video_name }}</td>
                                <td style="display: flex; align-items:center; gap: 10px; border: none; outline: none; color: #ffde59">
                                    <video class="blogLogo" src="{{ asset($video->video) }}"></video>
                                    <ion-icon name="film-outline"></ion-icon>
                                </td>
                                <td>{{ $video->status }}</td>
                                <td>                    
                                    <a href="{{ route('product.video.edit', ['id' => $video->id]) }}">
                                        <button class="btn btnEdit">
                                            <span>Edit</span>
                                           <img src="{{ asset('dashboardicons/edit.png') }}" alt="editIcon">
                                        </button>
                                    </a>
                                </td>
                                <td>                    
                                    <form action="{{ route('manage.video.delete', $video->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btnDelete btnDanger">
                                            <span>Delete</span>
                                            <img src="{{ asset('dashboardicons/delete.png') }}" alt="DeleteIcon">
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
