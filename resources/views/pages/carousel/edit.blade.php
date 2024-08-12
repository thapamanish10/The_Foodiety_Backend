@extends('pages.home')

@section('css')
    <link rel="stylesheet" href="{{ asset('./css/business.css') }}">
@endsection

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
        <form 
            action="{{ route('carousel.update', ['id' => $carousel->id]) }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="form"
        >
            @csrf
            @method('PUT')

            <div class="formHeading">
                <div class="formHeadingLeft">
                    <h3>Fill up the Information:</h3>
                    <p>Provide information about the restaurant to contact.</p>
                </div>
                <div class="buttonDiv">
                    <button class="btn btnCancle" type="button" onclick="window.history.back();">
                        <span>Cancel</span>
                        <img src="{{ asset('dashboardicons/cancle.png') }}" alt="CancleIcon">
                    </button>
                    <button class="btn btnAdd btnPrimary" type="submit">
                        <span>Update</span>
                        <img src="{{ asset('dashboardicons/update.png') }}" alt="UpdateIcon">
                    </button>
                </div>
            </div>
            <div class="formBody">
                <div class="row">
                    <div class="formGroup">
                        <label for="carousel_title">CAROUSEL TITLE: <span class="imp">*</span></label>
                        <input type="text" name="carousel_title" id="carousel_title" value="{{ $carousel->carousel_title }}">
                    </div>
                    <div class="formGroup">
                        <label for="carousel_status">STATUS: <span class="imp">*</span></label>
                        <select class="custom-select" id="carousel_status" name="carousel_status">
                            <option value="true" {{ $carousel->carousel_status == 'true' ? 'selected' : '' }}>True</option>
                            <option value="false" {{ $carousel->carousel_status == 'false' ? 'selected' : '' }}>False</option>
                        </select>
                    </div>
                </div>
                <label for="carousel_Image">CAROUSEL IMAGE: <span class="imp">*</span></label>
                <div class="formGroupImage">
                    <input type="file" name="carousel_Image" id="image" style="display: none;" accept="image/jpeg, image/png, image/jpg">
                    @if ($carousel->carousel_Image)
                    <img src="{{ asset($carousel->carousel_Image) }}" alt="Selected Image" id="selectedImage" onclick="document.getElementById('image').click();" style="display: block; max-width: 100%; max-height: 300px; margin-top: 10px;">
                    @else
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
                    @endif 
                    <span id="fileName">Drop your image here, Or browse</span>
                    <small>Supports: JPG, JPEG2000, PNG</small>
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
