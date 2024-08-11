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
        @if ($abouts->count() < 1)
            <div class="totelItems">
                <a href="{{ route('business.create') }}">
                    <button class="addReview add">
                        <span>Create</span>
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </button>
                </a>
            </div>
        @endif
        @if ($abouts->count() > 0)
            <div class="companyContainer">
                @foreach ($abouts as $about)
                    @if ($about->images)
                        <div class="carousel">
                            <div class="carousel-inner">
                                @foreach($about->images as $image)
                                <div class="carousel-item active">
                                    <img src="{{ asset($image->image) }}" style="max-width: 100%; max-height: 300px; margin-top: 10px;" alt="{{ $image->name }}">
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
                        <h3 class="companyTitle">{{ $about->company_name }}</h3>
                        <div class="companyHeadingButtons">
                            <a href="{{ route('business.edit', ['id' => $about->id]) }}">
                                <button class="addReview add">
                                    <span>Edit</span>
                                    <ion-icon name="create-outline"></ion-icon>
                                </button>
                            </a>
                            <a href="{{ route('business.image.create', ['id' => $about->id]) }}">
                                <button class="addReview add">
                                    <span>Add Images</span>
                                    <ion-icon name="add-circle-outline"></ion-icon>
                                </button>
                            </a>
                            @if ($about->images->count() > 0)
                                <a href="{{ route('business.manage.image', ['id' => $about->id]) }}">
                                    <button class="addReview add">
                                        <span>Manage Images</span>
                                        <ion-icon name="settings-outline"></ion-icon>
                                    </button>
                                </a>
                            @endif
                            <form action="{{ route('business.delete', $about->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
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
                        <h3 class="companyTitle">Company Desc :</h3>
                        <div class="companyText">{!! $about->about_text !!}</div>
                    </div>
                    <div class="companyContent">
                        <h3 class="companyTitle">Compeny Contact:</h3>
                        <div class="companyContactItem">
                            <img src="{{ asset('./assets/tele.png') }}" alt="">
                            <p class="companyContactItemText">{{ $about->phone_number }} {{ $about->optional_phone_number }}</p>
                        </div>
                        <div class="companyContactItem">
                            <img src="{{ asset('./assets/facebook.png') }}" alt="">
                            <p class="companyContactItemText">{{ $about->facebook_link }}</p>
                        </div>
                        <div class="companyContactItem">
                            <img src="{{ asset('./assets/youtube.png') }}" alt="">
                            <p class="companyContactItemText">{{ $about->youtube_link }}</p>
                        </div>
                        <div class="companyContactItem">
                            <img src="{{ asset('./assets/instagram.png') }}" alt="">
                            <p class="companyContactItemText">{{ $about->instagram_link }}</p>
                        </div>
                    </div>
                @endforeach
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