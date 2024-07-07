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
            <form action="{{ route('product.video.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                id="" class="form">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the restaurant to contact.</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="formBtn cancle" type="button">
                            <span>Cancel</span>
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </button>
                        <button class="formBtn update" type="submit">
                            <span>Upload</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <label for="product_id">Product Id:</label>
                        <input type="text" value="{{ $product->id }}" name="product_id" id="product_id" readonly>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="video_name">VIDEO NAME: <span class="imp">*</span></label>
                            <input type="text" value="{{ $data->video_name }}" name="video_name" id="video_name" required>
                        </div>
                        <div class="formGroup">
                            <label for="video_type">TYPE:<span class="imp">*</span></label>
                            <select class="custom-select" id="video_type" name="video_type" required>
                                <option value="">Video type? </option>
                                <option value="portrait" {{ $data->video_type == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                <option value="landscape" {{ $data->video_type == 'landscape' ? 'selected' : '' }}>Landscape</option>
                            </select>
                        </div>
                    </div>
                    <label for="video">PRODUCT VIDEO: <span class="imp">*</span></label>
                    <div class="formGroupImage">
                        <input type="file" name="video" id="video" style="display: none;" value="{{ $data->video }}" accept="video/mp4" required>
                        @if ($data->video)
                            <video id="selectedVideo" style="max-width: 100%; max-height: 300px; margin-top: 10px;" controls onclick="document.getElementById('video').click();">
                                <source src="{{ asset($data->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <img src="{{ asset('assets/video_up.png') }}" style="opacity: 0.5" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('video').click();">
                        @endif
                        <span id="fileName">Drop your video here, Or browse</span>
                        <small>Supports: MP4</small>
                    </div>
                    <div class="formGroup" hidden>
                        <label for="video_text">IMAGE DESC: </label>
                        <textarea type="text" cols="30" rows="10" name="video_text" id="features"></textarea>
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
            const fileInput = document.getElementById('video');
            const customButton = document.getElementById('customButton');
            const fileName = document.getElementById('fileName');
            const selectedVideo = document.getElementById('selectedVideo');

            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        selectedVideo.src = e.target.result;
                        selectedVideo.style.display = 'block';
                        customButton.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                    fileName.textContent = file.name;
                } else {
                    selectedVideo.style.display = 'none';
                    customButton.style.display = 'block';
                    fileName.textContent = 'Drop your video here, Or browse';
                }
            });
        });
    </script>
@endsection
