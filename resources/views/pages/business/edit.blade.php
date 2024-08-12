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
                action="{{ route('business.update', ['id' => $about->id]) }}" 
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
                    <div class="formGroup">
                        <label for="company_name">COMPANY NAME: <span class="imp">*</span> </label>
                        <input type="text" name="company_name" id="company_name" value="{{ $about->company_name }}">
                    </div>
                    <label for="company_logo">COMPANY LOGO: <span class="imp">*</span></label>
                    <div class="formGroupImage">
                        <input type="file" name="company_logo" id="image" style="display: none;" accept="image/jpeg, image/png, image/jpg">
                         @if ($about->company_logo)
                            <img src="{{ asset($about->company_logo) }}" alt="Selected Image" onclick="document.getElementById('image').click();" id="selectedImage" style="display: block; max-width: 100%; max-height: 300px; margin-top: 10px;">
                        @else
                            <img src="{{ asset('assets/upload.png') }}" alt="" id="customButton" onclick="document.getElementById('image').click();">
                        @endif
                        <span id="fileName">{{ $about->company_logo ? '' : 'Drop your image here, Or browse' }}</span>
                        <small>Supports: JPG, JPEG2000, PNG</small>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="phone_number">PHONE NUMBER: <span class="imp">*</span></label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ $about->phone_number }}">
                        </div>
                        <div class="formGroup">
                            <label for="optional_phone_number">OPT PHONE NUMBER:<span class="notimp">*</span></label>
                            <input type="text" name="optional_phone_number" id="optional_phone_number" value="{{  $about->optional_phone_number }}">
                        </div>
                        <div class="formGroup">
                            <label for="email_address">EMAIL ADDRESS: <span class="imp">*</span></label>
                            <input type="text" name="email_address" id="email_address" value="{{ $about->email_address }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="facebook_link">FACEBOOK LINK:</label>
                            <input type="text" name="facebook_link" id="facebook_link" value="{{ $about->facebook_link }}">
                        </div>
                        <div class="formGroup">
                            <label for="instagram_link">INSTAGRAM LINK:</label>
                            <input type="text" name="instagram_link" id="instagram_link" value="{{ $about->instagram_link }}">
                        </div>
                        <div class="formGroup">
                            <label for="youtube_link">YOUTUBE LINK:</label>
                            <input type="text" name="youtube_link" id="youtube_link" value="{{ $about->youtube_link}}">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="about_text">COMPANY ABOUT TEXT:<span class="imp">*</span></label>
                        <textarea type="text" cols="30" rows="10" name="about_text" id="editor">{{  $about->about_text }}</textarea>
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
