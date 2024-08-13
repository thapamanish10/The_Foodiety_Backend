@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(2) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="singlePageInfo">
            <div class="singlePageHeading">
                <h3>{{ $data->name }}</h3>
                <div class="reviewStar">
                    <img src="{{ asset('assets/rating.png') }}" class="ratingLogo" alt="">
                    <p>{{ $data->rating }} / 10</p>
                </div>
            </div>
            <div class="singlePageInfoDetail">
                <div class="detailItem">
                   <img src="{{ asset('dashboardicons/location.png') }}" alt="LocationIcon">
                    <span>{{ $data->location }}</span>
                </div>
                <div class="detailItem">
                   <img src="{{ asset('dashboardicons/phone.png') }}" alt="PhoneIcon">
                    <span>{{ $data->phone_number }}</span>
                </div>
                <div class="detailItem">
                    <img src="{{ asset('dashboardicons/website.png') }}" alt="WebsiteIcon">
                    <span>Website</span>
                </div>
                <div class="detailItem">
                   <img src="{{ asset('dashboardicons/burger.png') }}" alt="MenuIcon">
                    <span>Menu</span>
                </div>
                <div class="detailItem">
                   <img src="{{ asset('dashboardicons/time.png') }}" alt="TimeIcon">
                    <span>Open now {{ $data->opening_time }}</span>
                </div>
                <div class="detailItem">
                    <img src="{{ asset('dashboardicons/info.png') }}" alt="InfoIcon">
                    <span>Improve this listing</span>
                </div>
                <div class="detailItem btn btnEdit">
                    <a href="{{ route('product.location', ['id' => $data->id]) }}">
                        <img src="{{ asset('dashboardicons/edit.png') }}" alt="EditIcon">
                    </a>
                </div>
            </div>
            <div class="resturantPhotosAndVideos">
                <div class="singlePageSubHeading">
                    <h3>Photos & Videos</h3>
                    <a href="{{ route('product.image.create', ['id' => $data->id]) }}">
                        <button class="btn btnCreate">
                            <span>Add Image</span>
                            <img src="{{ asset('dashboardicons/image.png') }}" alt="ImageIcon">
                        </button>
                    </a>
                    <a href="{{ route('product.video.create', ['id' => $data->id]) }}">
                        <button class="btn btnEdit">
                            <span>Add Videos</span>
                             <img src="{{ asset('dashboardicons/video.png') }}" alt="VideoIcon">
                        </button>
                    </a>
                    <a href="{{ route('manage.image', ['id'=> $data->id]) }}">
                        <button class="btn btnManage">
                            <span>Manage</span>
                            <img src="{{ asset('dashboardicons/manage.png') }}" alt="ManageIcon">
                        </button>
                    </a>
                    <form action="{{ route('product.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btnDelete btnDanger">
                            <span>Delete</span>
                            <img src="{{ asset('dashboardicons/delete.png') }}" alt="DeleteIcon">
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
                                <button class="carousel-control-prev carouselBtn"><img src="{{ asset('dashboardicons/left-arrow.png') }}" alt="LeftArrowIcon"></button>
                                <button class="carousel-control-next carouselBtn"><img src="{{ asset('dashboardicons/right-arrow.png') }}" alt="RightArrowIcon"></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="resturantDetail">
                <div class="singlePageSubHeading">
                    <h3>Details</h3>
                    <a href="{{ route('product.about', ['id' => $data->id]) }}" class="btn btnEdit">
                        <img src="{{ asset('dashboardicons/edit.png') }}" alt="EditIcon">
                    </a>
                </div>
                <div class="resturantAbout">
                    <div class="aboutItme">
                        <h3>ABOUT</h3>
                        <p>{!! $data->about_us !!}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>PRICE RANGE</h3>
                        <p>{{ $data->price_range }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>CUISINES</h3>
                        <p>{{ $data->cuisines }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>SPECIAL DIETS</h3>
                        <p>{{ $data->special_diets }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>MEALS</h3>
                        <p>{{ $data->meals }}</p>
                    </div>
                    <div class="aboutItme">
                        <h3>FEATURES</h3>
                        <p>{!! $data->features !!}</p>
                    </div>
                    <div class="aboutItme"></div>
                </div>
            </div>
            <div class="resturantReviews">
                <div class="singlePageSubHeading">
                    <h3>reviews & Ratings</h3>
                    <a href="{{ route('product.about', ['id' => $data->id]) }}" class="btn btnEdit">
                        <img src="{{ asset('dashboardicons/edit.png') }}" alt="EditIcon">
                    </a>
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
                    <div class="singlePageSubHeading">
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
                                            <img src="{{ asset('dashboardicons/edit.png') }}" alt="EditIcon">
                                        </a>
                                    </div>
                                </div>
                                <div class="reviewDetails">
                                    <h2>{{ $review->review_title }}</h2>
                                    <h5>{{ $review->created_at->format('M d, Y') }} • {{ $review->visit_with }}</h5>
                                    <p>{{ strip_tags($review->review_text) }}</p>
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