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
            <form action="{{ route('product.review.update', ['id' => $review->id]) }}" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the restaurant to contact.</p>
                    </div>
                    <div class="buttonDiv">
                        <button type="button" class="formBtn cancle">
                            <span>Cancel</span>
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </button>
                        <button type="submit" class="formBtn update">
                            <span>Update</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup" hidden>
                        <label for="product_id" hidden>Product Id:<span class="imp" hidden>*</span></label>
                        <input type="text" value="{{ $product->id }}" name="product_id" id="product_id" hidden readonly>
                    </div>
                    <div class="formGroup">
                        <label for="review_title">Review Title:<span class="imp">*</span></label>
                        <input type="text" value="{{ $review->review_title }}" name="review_title" id="review_title">
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="visitDate">Visit Date:<span class="imp">*</span></label>
                            <input type="date" value="{{ $review->visit_date }}" name="visit_date" id="visit_date">
                        </div> 
                        <div class="formGroup">
                            <label for="visitWith">Visit With:<span class="imp">*</span></label>
                            <select class="custom-select" id="visit_with" name="visit_with">
                                <option value="Business" {{($review->visit_with == 'Business') ? 'selected' : ''; }}>Business</option>
                                <option value="Couples" {{($review->visit_with == 'Couples') ? 'selected' : ''; }}>Couples</option>
                                <option value="Family" {{($review->visit_with == 'Family') ? 'selected' : ''; }}>Family</option>
                                <option value="Friends" {{($review->visit_with == 'Friends') ? 'selected' : ''; }}>Friends</option>
                                <option value="Solo" {{($review->visit_with == 'Solo') ? 'selected' : ''; }}>Solo</option>
                            </select>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="review_text">Review Text:<span class="imp">*</span></label>
                        <textarea cols="30" rows="10" name="review_text" id="review_text">{{ $review->review_text }}</textarea>
                        <p class="minReq">0/100 min characters</p>
                    </div>
                    <label for="image">IMAGE FILE:</label>
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