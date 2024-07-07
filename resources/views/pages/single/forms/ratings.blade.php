@extends('pages.home')

@section('content')
    <main class="dashboardContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(2) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="detailsformBody">
            <form action="" id="" class="form">
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the restaurant to contact.</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="formBtn cancle">
                            <span>Cancel</span>
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </button>
                        <button class="formBtn update">
                            <span>Update</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <label for="food">FOOD:</label>
                        <input type="text" value="{{ $data->food }}" name="food" id="food">
                    </div>
                    <div class="formGroup">
                        <label for="service">SERVICE:</label>
                        <input type="text" value="{{ $data->service }}" name="service" id="service">
                    </div>
                    <div class="formGroup">
                        <label for="value">VALUE:</label>
                        <input type="text" value="{{ $data->value }}" name="value" id="value">
                    </div>
                    <div class="formGroup">
                        <label for="atmosphere">ATMOSPHERE:</label>
                        <input type="text" value="{{ $data->atmosphere }}" name="atmosphere" id="atmosphere">
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
