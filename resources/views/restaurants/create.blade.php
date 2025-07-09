@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Provide information about the Restaurant.</p>
        </div>

        <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name :*</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    required>
            </div>

            <label for="logo" class="form-label">Restaurant Logo :*</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="logo" name="logo" multiple accept="image/*"
                    style="display: none;">
                <div id="imagelogoPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('logo').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>

            <div class="form-group">
                <label for="desc" class="form-label">Content :*</label>
                <textarea type="text" cols="30" rows="10" name="desc" id="editor">{{ old('desc') }}</textarea>
            </div>

            <div class="form-group">
                <label for="desc2" class="form-label">Content 2 :*</label>
                <textarea type="text" cols="30" rows="10" name="desc2" id="desc2">{{ old('desc2') }}</textarea>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="publish_at" class="form-label">Publish Date :*</label>
                    <input type="date" class="form-control" id="publish_at" name="publish_at"
                        value="{{ old('publish_at') }}" required>
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status :*</label>
                    <select class="form-select" id="status" name="status" value="{{ old('status') }}" required>
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="latitude" class="form-label">Latitude : (optional)</label>
                    <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude"
                        value="{{ old('latitude') }}">
                </div>

                <div class="form-group">
                    <label for="longitude" class="form-label">Longitude : (optional)</label>
                    <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude"
                        value="{{ old('longitude') }}">
                </div>
            </div>
            <br>
            <br>
            <div class="container-heading">
                <h3>Restaurant Details:</h3>
                <p>Provide information about the Restaurant details.</p>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="rating" class="form-label">Rating : (optional)</label>
                    <input type="text" class="form-control" id="rating" name="rating" value="{{ old('rating') }}">
                </div>

                <div class="form-group">
                    <label for="number" class="form-label">Phone Number : (optional)</label>
                    <input type="text" class="form-control" id="number" name="number"
                        value="{{ old('number') }}">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email : (optional)</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email') }}">
                </div>
            </div>
            <br>
            <br>
            <div class="container-heading">
                <h3>Ratings:</h3>
                <p>Provide information about the Restaurant ratings.</p>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="services" class="form-label">Services Rating : (optional)</label>
                    <input type="text" class="form-control" id="services" name="services"
                        value="{{ old('services') }}">
                </div>

                <div class="form-group">
                    <label for="food" class="form-label">Food Rating : (optional)</label>
                    <input type="text" class="form-control" id="food" name="food"
                        value="{{ old('food') }}">
                </div>

                <div class="form-group">
                    <label for="value" class="form-label">Value Rating : (optional)</label>
                    <input type="text" class="form-control" id="value" name="value"
                        value="{{ old('value') }}">
                </div>

                <div class="form-group">
                    <label for="atmosphere" class="form-label">Atmosphere Rating : (optional)</label>
                    <input type="text" class="form-control" id="atmosphere" name="atmosphere"
                        value="{{ old('atmosphere') }}">
                </div>
            </div>
            <label for="images" class="form-label">Additional Images : *</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*"
                    style="display: none;">
                <div id="imagePreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('images').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            <br>
            <div class="form-group-buttons">
                <a href="{{ route('restaurants.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Create Restaurant</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('logo');
            const previewContainer = document.getElementById('imagelogoPreviews');
            const maxFiles = 20; // Set maximum number of logo
            let selectedFiles = [];

            // Handle file selection
            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);

                // Check total files won't exceed max
                if (selectedFiles.length + files.length > maxFiles) {
                    alert(`You can upload a maximum of ${maxFiles} logo`);
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
@endsection
@section('ckScript')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#desc2'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
