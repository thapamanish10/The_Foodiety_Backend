@extends('pages.home')

@section('content')
@include('components.loading-screen')
<div class="container">
    <div class="container-heading">
        <h3>Fill up the Information:</h3>
        <p>Provide information about the blog post.</p>
    </div>
    <form 
    action="{{ route('carousel.update', ['carousel' => $carousel->id]) }}" 
    method="POST" 
    enctype="multipart/form-data"
    class="form"
>
    @csrf
    @method('PUT')

                    <div class="row">
                        <div class="form-group">
                            <label for="carousel_title">CAROUSEL TITLE: <span class="imp">*</span> </label>
                            <input type="text" name="carousel_title" id="carousel_title" value="{{ $carousel->carousel_title }}">
                        </div>
                        <div class="form-group">
                           <label for="carousel_status">STATUS: <span class="imp">*</span></label>
                           <select class="form-select"  id="carousel_status" name="carousel_status">
                            <option value="true" {{ $carousel->carousel_status == 'true' ? 'selected' : '' }}>True</option>
                            <option value="false" {{ $carousel->carousel_status == 'false' ? 'selected' : '' }}>False</option>
                        </select>
                        </div>
                    </div>
                    <label for="images" class="form-label">CAROUSEL IMAGE</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="images" name="carousel_Image"  accept="image/*"
                    style="display: none;">
                    @if ($carousel->carousel_Image)
                    <img src="{{ asset($carousel->carousel_Image) }}" width="150" style="object-fit: cover">
                    @endif
                <div id="imagePreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('images').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            <br>
            <div class="form-group-buttons">
                <a href="{{ route('carousel.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Update Carousel</button>
            </div>
            </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('imagePreviews');
            const maxFiles = 20; // Set maximum number of images
            let selectedFiles = [];

            // Handle file selection
            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);

                // Check total files won't exceed max
                if (selectedFiles.length + files.length > maxFiles) {
                    alert(`You can upload a maximum of ${maxFiles} images`);
                    return;
                }

                files.forEach(file => {
                    // Validate file type and size
                    if (!file.type.match('image.*')) {
                        alert(`${file.name} is not an image file`);
                        return;
                    }

                    // 100MB in bytes (100 * 1024 * 1024)
                    if (file.size > 104857600) {
                        alert(`${file.name} is too large (max 100MB)`);
                        return;
                    }

                    // Add to selected files
                    selectedFiles.push(file);

                    // Create preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'image-preview position-relative';
                        preview.style.width = '150px';

                        preview.innerHTML = `
                        <img src="${e.target.result}" class="img-thumbnail" alt="Preview">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-image">
                            ×
                        </button>
                    `;

                        previewContainer.appendChild(preview);

                        // Add remove functionality
                        preview.querySelector('.remove-image').addEventListener('click',
                            function() {
                                preview.remove();
                                selectedFiles = selectedFiles.filter(f => f !== file);
                                updateFileInput();
                            });
                    };
                    reader.readAsDataURL(file);
                });

                updateFileInput();
            });

            // Update the actual file input with remaining files
            function updateFileInput() {
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                imageInput.files = dataTransfer.files;
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('blogForm');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const submitButton = document.getElementById('submitButton');

            form.addEventListener('submit', function(e) {
                // Show loading spinner
                loadingOverlay.style.display = 'flex';

                // Disable submit button to prevent multiple submissions
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'Processing...';
                }
            });
        });
    </script>
@endsection

@section('jsScript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('blogForm');
                    const submitButton = document.getElementById('submitButton');

                    // Function to check if all fields are filled
                    function checkAllFieldsFilled() {
                        constFields = form.querySelectorAll(']');
                        let allFilled = true;
                        Fields.forEach(field => {
                            if (field.value.trim() === '') {
                                allFilled = false;
                            }
                        });
                        return allFilled;
                    }
    </script>
@endsection