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
            <form action="{{ route('product.store') }}" id="" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the restaurant to contact.</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="btn btnCancle">
                            <span>Cancel</span>
                            <img src="{{ asset('dashboardicons/cancle.png') }}" alt="CancleIcon">
                        </button>
                        <button class="btn btnCreate btnPrimary" type="submit">
                            <span>Create</span>
                             <img src="{{ asset('dashboardicons/add.png') }}" alt="UpdateIcon">
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <label for="name">RESTAURANT NAME: <span class="imp">*</span> </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <label for="price_range">RESTAURANT LOGO: <span class="imp">*</span></label>
                    <div class="formGroupImage">
                        <input type="file" name="company_logo" id="image" style="display: none;" value="{{ old('company_logo') }}" accept="image/jpeg, image/png, image/jpg">
                        <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
                        <img src="" alt="Selected Image" id="selectedImage" style="display:none; max-width: 100%; max-height: 300px; margin-top: 10px;" onclick="document.getElementById('image').click();">
                        <span id="fileName">Drop your image here, Or browse</span>
                        <small>Supports: JPG, JPEG2000, PNG</small>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="location">LOCATION:<span class="imp">*</span></label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}">
                        </div>
                        <div class="formGroup">
                            <label for="phone_number">PHONE NUMBER:<span class="imp">*</span></label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                        </div>
                        <div class="formGroup">
                            <label for="rating">RATING:<span class="imp">*</span></label>
                            <input type="number" name="rating" id="rating" value="{{ old('rating') }}">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="about_us">ABOUT:<span class="imp">*</span></label>
                        <textarea type="text" cols="30" rows="10" name="about_us" id="editor">{{ old('about_us') }}</textarea>
                    </div>
                    <div class="formGroup">
                        <label for="features">FEATURES:<span class="imp">*</span></label>
                        <textarea type="text" cols="30" rows="10" name="features" id="features">{{ old('features') }}</textarea>
                    </div>
                </div>
            </form>
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
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#features'))
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
            const selectedImage = document.getElementById('selectedImage');

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        selectedImage.src = e.target.result;
                        selectedImage.style.display = 'block';
                        customButton.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                    fileName.textContent = file.name;
                } else {
                    selectedImage.style.display = 'none';
                    customButton.style.display = 'block';
                    fileName.textContent = 'Drop your image here, Or browse';
                }
            });
        });
    </script>
@endsection
@section("displayImageScript")
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const fileName = document.getElementById('fileName');
            const selectedImage = document.getElementById('selectedImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                    selectedImage.style.display = 'block';
                    document.getElementById('customButton').style.display = 'none';
                };
                reader.readAsDataURL(file);
                fileName.textContent = file.name;
            } else {
                selectedImage.style.display = 'none';
                document.getElementById('customButton').style.display = 'block';
                fileName.textContent = 'Drop your image here, Or browse';
            }
        });
    </script>
@endsection