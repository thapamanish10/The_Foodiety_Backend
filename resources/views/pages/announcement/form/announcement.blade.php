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
            <form action="" id="" class="form" method="POST" enctype="multipart/form-data">
                @csrf
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
                        <button class="formBtn update" type="submit">
                            <span>Publish</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <label for="event_title">EVENT TITLE:</label>
                        <input type="text" value="" name="event_title" id="event_title">
                    </div>
                    <label for="price_range">EVENT IMAGE:</label>
                    <div class="formGroupImage">
                        <input type="file" name="event_image" id="image" style="display: none;">
                        <img src="{{ asset('assets/upload.png') }}" alt="" id="customButton">
                        <span id="fileName">Drop your image here, Or browse</span>
                        <small>Supports: JPG, JPEG2000, PNG</small>
                    </div>
                    <div class="formGroup">
                        <label for="event_text">EVENT TEXT:</label>
                        <textarea type="text" cols="30" rows="10" name="event_text" id="event_texts"></textarea>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="event_start">EVENT START:</label>
                            <input type="date" value="" name="event_start" id="event_start">
                        </div>
                        <div class="formGroup">
                            <label for="event_end">EVENT END:</label>
                            <input type="date" value="" name="event_end" id="event_end">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="event_time">EVENT TIME:</label>
                        <input type="time" value="" name="event_time" id="event_time">
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </main>
@endsection

@section('ckScript')
    <script>
        ClassicEditor
            .create(document.querySelector('#event_texts'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
@section('jsScript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const customButton = document.getElementById('customButton');
            const fileName = document.getElementById('fileName');

            customButton.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                } else {
                    fileName.textContent = 'No file chosen';
                }
            });
        });
    </script>
@endsection
