@extends('pages.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('./css/business.css') }}">
@endsection

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
            <form 
                action="{{ route('carousel.store') }}" 
                method="POST" 
                enctype="multipart/form-data"
                class="form"
            >
                @csrf
                @if(isset($about->id))
                    @method('PUT')
                @endif

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
                            <span>{{ isset($about->id) ? 'Update' : 'Create' }}</span>
                            <ion-icon name="{{ isset($about->id) ? 'create-outline' : 'add-circle-outline' }}"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="row">
                        <div class="formGroup">
                            <label for="carousel_title">CAROUSEL TITLE: <span class="imp">*</span> </label>
                            <input type="text" name="carousel_title" id="carousel_title" value="{{ old('carousel_title') }}">
                        </div>
                        <div class="formGroup">
                           <label for="carousel_status">STATUS: <span class="imp">*</span></label>
                            <select class="custom-select" id="visit_with" name="carousel_status">
                                <option value="{{ old('carousel_Image') }}">Add to Carousel? </option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                        </div>
                    </div>
                    <label for="carousel_Image">CAROUSEL IMAGE: <span class="imp">*</span></label>
                    <div class="formGroupImage">
                        <input type="file" name="carousel_Image" id="image" style="display: none;" value="{{ old('carousel_Image') }}" accept="image/jpeg, image/png, image/jpg">
                        <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
                        <img src="" alt="Selected Image" id="selectedImage" style="display:none; max-width: 100%; max-height: 300px; margin-top: 10px;" onclick="document.getElementById('image').click();">
                        <span id="fileName">Drop your image here, Or browse</span>
                        <small>Supports: JPG, JPEG2000, PNG</small>
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
