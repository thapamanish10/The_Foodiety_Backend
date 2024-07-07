@extends('pages.home')

@section('content')
    <main class="dashboardContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="singlePageInfo">
            <div class="rNameRating">
                <h3>{{ $data->name }}</h3>
                <div class="reviewStar">
                    <img src="{{ asset('assets/rating.png') }}" class="ratingLogo" alt="">
                    <p>{{ $data->rating }} / 10</p>
                </div>
            </div>
            <div class="resturantDetails">
                <div class="detailItem">
                    <ion-icon name="location-outline"></ion-icon>
                    <span>{{ $data->location }}</span>
                </div>
                <div class="detailItem">
                    <ion-icon name="call-outline"></ion-icon>
                    <span>{{ $data->phone_number }}</span>
                </div>
                <div class="detailItem">
                    <ion-icon name="laptop-outline"></ion-icon>
                    <span>Website</span>
                </div>
                <div class="detailItem">
                    <ion-icon name="cafe-outline"></ion-icon>
                    <span>Menu</span>
                </div>
                <div class="detailItem">
                    <ion-icon name="time-outline"></ion-icon>
                    <span>Open now {{ $data->opening_time }}</span>
                </div>
                <div class="detailItem">
                    <ion-icon name="information-circle-outline"></ion-icon>
                    <span>Improve this listing</span>
                </div>
                <div class="detailItem editDetail">
                    <a href="{{ route('product.location', ['id' => $data->id]) }}">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <div class="resturantPhotosAndVideos">
                <div class="photosHeading">
                    <h3>Photos & Videos</h3>
                    <a href="{{ route('product.image.create', ['id' => $data->id]) }}">
                        <button class="addReview add">
                            <span>Add Image</span>
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </button>
                    </a>
                    <a href="{{ route('product.video.create', ['id' => $data->id]) }}">
                        <button class="addReview add">
                            <span>Add Videos</span>
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </button>
                    </a>
                    <a href="{{ route('manage.image', ['id'=> $data->id]) }}">
                        <button class="addReview add">
                            <span>Manage</span>
                            <ion-icon name="settings-outline"></ion-icon>
                        </button>
                    </a>
                    <form action="{{ route('product.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                        @csrf
                        @method('DELETE')
                        <button class="addReview add delete">
                            <span>Delete</span>
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                    </form>
                </div>
                <div class="photoImages">
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
                </div>
            </div>
            <div class="resturantDetail">
                <div class="detailHeading">
                    <h3>Details</h3>
                    <a href="{{ route('product.about', ['id' => $data->id]) }}">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
                </div>
                <div class="resturantAbout">
                    <div class="aboutItme">
                        <h3>About</h3>
                        <p class="mt-2 text-lg leading-6 text-gray-600">{!! $data->about_us !!}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>PRICE RANGE</h3>
                        <p class="mt-2 text-lg leading-6 text-gray-600">{{ $data->price_range }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>CUISINES</h3>
                        <p class="mt-2 text-lg leading-6 text-gray-600">{{ $data->cuisines }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>SPECIAL DIETS</h3>
                        <p class="mt-2 text-lg leading-6 text-gray-600">{{ $data->special_diets }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>MEALS</h3>
                        <p class="mt-2 text-lg leading-6 text-gray-600">{{ $data->meals }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>FEATURES</h3>
                        <p class="mt-2 text-lg leading-6 text-gray-600">{!! $data->features !!}</p>
                    </div>
                    <div class="aboutItme"></div>
                </div>
            </div>
            <div class="resturantReviews">
                <div class="reviewsHeading">
                    <h3>reviews & Ratings</h3>
                    {{-- <span class="hidden sm:block">
                        <button type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                            </svg>
                            Edit
                        </button>
                    </span> --}}
                </div>
                <div class="reviewsBody">
                    <div class="reviewStar">
                        <p>{{ $data->rating }} / 10</p>
                        <img src="{{ asset('assets/rating.png') }}" class="ratingLogo" alt="">
                    </div>
                    <div class="reviewBar">
                        <div class="reviewBarItem">
                            <div class="reviewItemIcon">
                                <ion-icon name="fast-food-outline"></ion-icon>
                                <span>Food</span>
                            </div>
                            <div class="ratingMark">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="reviewBarItem">
                            <div class="reviewItemIcon">
                                <ion-icon name="alarm-outline"></ion-icon>
                                <span>Service</span>
                            </div>
                            <div class="ratingMark">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="reviewBarItem">
                            <div class="reviewItemIcon">
                                <ion-icon name="wallet-outline"></ion-icon>
                                <span>Value</span>
                            </div>
                            <div class="ratingMark">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="reviewBarItem">
                            <div class="reviewItemIcon">
                                <ion-icon name="bonfire-outline"></ion-icon>
                                <span>Atmosphere</span>
                            </div>
                            <div class="ratingMark">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="noOfReviews">
                        <h3>Total Reviews ({{ count($data->reviews) }})</h3>
                        @if (count($data->reviews) < 1)
                            <a href="{{ route('product.review', ['id' => $data->id]) }}">
                                <button class="addReview add">
                                    <span>Create</span>
                                    <ion-icon name="add-circle-outline"></ion-icon>
                                </button>
                            </a>
                        @endif
                    </div>
                    <div class="review">
                        @if ($data->reviews->isEmpty())
                            <p>No reviews yet.</p>
                        @else
                            @foreach ($data->reviews as $review)
                                <div class="reviewerProfile">
                                    <img src="{{ asset('assets/profile.png') }}" alt="">
                                    <div class="reviewerName">
                                        <h3>{{ $review->username }}</h3>
                                        <span>Owner</span>
                                    </div>
                                    <div class="reviewOption">
                                        <a href="{{ route('product.review.edit', ['id' => $review->id]) }}">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                                <div class="reviewDetails">
                                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $review->review_title }}</h2>
                                    <h5>{{ $review->created_at->format('M d, Y') }} • {{ $review->visit_with }}</h5>
                                    <p class="mt-2 text-lg leading-6 text-gray-600">{{ strip_tags($review->review_text) }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
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