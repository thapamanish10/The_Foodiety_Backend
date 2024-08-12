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
            <form action="{{ route('business.manage.image.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                id="" class="form">
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
                            <span>Upload</span>
                            <img src="{{ asset('dashboardicons/image.png') }}" alt="AddIcon">
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup" hidden >
                        <label for="about_id" >About Id:</label>
                        <input type="text" value="{{ $about->id }}" name="about_id" id="about_id" >
                    </div>
                    <div class="formGroup">
                        <label for="image_name">IMAGE NAME: <span class="imp">*</span></label>
                        <input type="text" value="{{ $data->image_name }}" name="image_name" id="image_name">
                    </div>
                    <label for="image">PRODUCT IMAGE: <span class="imp">*</span></label>
                    <div class="formGroupImage">
                        <input type="file" name="image" id="image" style="display: none;" value="{{ old('image') }}" accept="image/jpeg, image/png, image/jpg">
                        @if ($data->image)
                            <img src="{{ asset($data->image) }}" alt="Selected Image" id="selectedImage" onclick="document.getElementById('image').click();" style="display: block; max-width: 100%; max-height: 300px; margin-top: 10px;">
                        @else
                            <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
                        @endif 
                        <span id="fileName">Drop your image here, Or browse</span>
                        <small>Supports: JPG, JPEG2000, PNG</small>
                    </div>
                    <div class="formGroup" hidden>
                        <label for="image_text">IMAGE DESC: </label>
                        <textarea type="text" cols="30" rows="10" name="image_text" id="features"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('ckScript')
    <script>
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
