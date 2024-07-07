@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(2) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
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
                        <button class="formBtn cancle">
                            <span>Cancle</span>
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </button>
                        <button class="formBtn update">
                            <span>Update</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon></button>
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
