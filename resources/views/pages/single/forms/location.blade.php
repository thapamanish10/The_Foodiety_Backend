@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
             <span>{{ Request::segment(2) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="locationformBody">
            <form action="{{ route('product.location.store', $data->id) }}" id="" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>fill up the Information:</h3>
                        <p>Provide information about the resturant to contact.</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="btn btnCancle">
                            <span>Cancle</span>
                            <img src="{{ asset('dashboardicons/cancle.png') }}" alt="CancleIcon">
                        </button>
                        <button class="btn btnUpdate btnPrimary">
                            <span>Update</span>
                            <img src="{{ asset('dashboardicons/update.png') }}" alt="UpdateIcon">
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <div class="labelIcon">
                            <label for="">Location:</label>
                            <ion-icon name="location-outline"></ion-icon>
                        </div>
                        <input type="text" name="location" value="{{ $data->location }}">
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <div class="labelIcon">
                                <label for="">Latitude:</label>
                                <ion-icon name="location-outline"></ion-icon>
                            </div>
                            <input type="text" name="latitude" value="{{ $data->latitude }}">
                        </div>
                        <div class="formGroup">
                            <div class="labelIcon">
                                <label for="">longitude:</label>
                                <ion-icon name="location-outline"></ion-icon>
                            </div>
                            <input type="text" name="longitude" value="{{ $data->longitude }}">
                        </div>
                    </div>
                     <div class="row">
                        <div class="formGroup">
                            <div class="labelIcon">
                                <label for="">Phone:</label>
                                <ion-icon name="call-outline"></ion-icon>
                            </div>
                            <input type="text" name="phone_number" value="{{ $data->phone_number }}">
                        </div>
                        <div class="formGroup">
                            <div class="labelIcon">
                                <label for="">Website:</label>
                                <ion-icon name="laptop-outline"></ion-icon>
                            </div>
                            <input type="text" name="website_link" value="{{ $data->website_link }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <div class="labelIcon">
                                <label for="">Menu:</label>
                                <ion-icon name="cafe-outline"></ion-icon>
                            </div>
                            <input type="text" name="menu" value="{{ $data->menu }}">
                        </div>
                        <div class="formGroup">
                            <div class="labelIcon">
                                <label for="">Opening Time:</label>
                                <ion-icon name="time-outline"></ion-icon>
                            </div>
                            <input type="text" name="opening_time" value="{{ $data->opening_time }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
