@extends('pages.home')

@section('content')
    <main class="dashboardContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
            <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
            <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span>{{ Request::segment(2) }}</span>
            <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="detailsformBody">
            <form action="" id="" class="form">
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the restaurant to contact.</p>
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
