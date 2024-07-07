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
            <form action="{{ route('product.image.store', $data->id) }}" method="POST" enctype="multipart/form-data"
                id="" class="form">
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
                        <button class="formBtn update">
                            <span>Upload</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup" hidden>
                        <label for="product_id" hidden>Product Id:</label>
                        <input type="text" value="{{ $data->id }}" name="product_id" id="product_id" hidden>
                    </div>
                    <div class="row">

                    <div class="formGroup">
                        <label for="image_name">IMAGE NAME: <span class="imp">*</span></label>
                        <input type="text" value="" name="image_name" id="image_name">
                    </div>
                    <div class="formGroup">
                            <label for="image_type">TYPE:<span class="imp">*</span></label>
                            <select class="custom-select" id="image_type" name="image_type">
                                <option value="">Image type? </option>
                                <option value="portrait">Portrait</option>
                                <option value="landscape">Landscape</option>
                            </select>
                        </div>
                    </div>
                    <label for="image">CAROUSEL IMAGE: <span class="imp">*</span></label>
                    <div class="formGroupImage">
                        <input type="file" name="image" id="image" style="display: none;" value="{{ old('image') }}" accept="image/jpeg, image/png, image/jpg">
                        <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
                        <img src="" alt="Selected Image" id="selectedImage" style="display:none; max-width: 100%; max-height: 300px; margin-top: 10px;" onclick="document.getElementById('image').click();">
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
