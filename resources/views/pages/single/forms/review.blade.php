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
            <form action="{{ route('product.review.create', $data->id) }}" id="" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
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
                    <div class="formGroup" hidden>
                        <label for="product_id">Product Id:</label>
                        <input type="text" value="{{ $data->id }}" name="product_id" id="product_id">
                    </div>
                    <div class="formGroup">
                        <label for="review_title">Review Title:<span class="imp">*</span></label>
                        <input type="text" value="" name="review_title" id="review_title">
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="visitDate">Visit Date:<span class="imp">*</span></label>
                            <input type="date" value="" name="visit_date" id="visit_date">
                        </div> 
                        <div class="formGroup">
                            <label for="visitWith">Visit With:<span class="imp">*</span></label>
                            <select class="custom-select" id="visit_with" name="visit_with">
                                <option value="">Who did you go with? </option>
                                <option value="Business">Business</option>
                                <option value="Couples">Couples</option>
                                <option value="Family">Family</option>
                                <option value="Friends">Friends</option>
                                <option value="Solo">Solo</option>
                            </select>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="review_text">Review Text:<span class="imp" hidden>*</span></label>
                        <textarea type="text" cols="30" rows="10" name="review_text" id="review_text"></textarea>
                    </div>
                    <label for="image" hidden>IMAGE FILE:</label>
                    <div class="formGroupImage">
                        <input type="file" name="image" id="image" style="display: none;" value="{{ old('image') }}" accept="image/jpeg, image/png, image/jpg">
                        <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
                        <img src="" alt="Selected Image" id="selectedImage" style="display:none; max-width: 100%; max-height: 300px; margin-top: 10px;" onclick="document.getElementById('image').click();">
                        <span id="fileName">Drop your image here, Or browse</span>
                        <small>Supports: JPG, JPEG2000, PNG</small>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('ckScript')
    <script>
        ClassicEditor
            .create(document.querySelector('#review_text'))
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