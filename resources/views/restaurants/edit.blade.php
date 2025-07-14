@extends('pages.home')

@section('content')
    <div class="container">
        <h1>Edit Restaurant</h1>

        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Name :*</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $restaurant->name) }}" required>
            </div>

            <label for="logo" class="form-label">Restaurant Logo :*</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="logo" name="logo" multiple accept="image/*"
                    style="display: none;">
                @if ($restaurant->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}" width="150"
                            class="img-thumbnail">
                    </div>
                @endif
                <div id="imagelogoPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('logo').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>

            <div class="form-group">
                <label for="desc" class="form-label">Content :*</label>
                <textarea type="text" cols="30" rows="10" name="desc" id="editor">{{ old('desc', $restaurant->desc) }}</textarea>
            </div>

            <div class="form-group">
                <label for="desc2" class="form-label">Content 2 :*</label>
                <textarea type="text" cols="30" rows="10" name="desc2" id="desc2">{{ old('desc2', $restaurant->desc2) }}</textarea>
            </div>
            <br>
            <br>
            <div class="container-heading">
                <h3>Restaurant Details:</h3>
                <p>Provide information about the Restaurant details.</p>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="publish_at" class="form-label">Publish Date :*</label>
                    <input type="date" class="form-control" id="publish_at" name="publish_at"
                        value="{{ old('publish_at', $restaurant->publish_at) }}" required>
                </div>
                <div class="form-group">
                    <label for="status" class="form-label">Status :*</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="public" {{ old('status', $restaurant->status) === 'public' ? 'selected' : '' }}>
                            Public</option>
                        <option value="private" {{ old('status', $restaurant->status) === 'private' ? 'selected' : '' }}>
                            Private</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="latitude" class="form-label">Latitude : (optional)</label>
                    <input type="text" class="form-control" id="latitude" name="latitude"
                        value="{{ old('latitude', $restaurant->latitude) }}">
                </div>

                <div class="form-group">
                    <label for="longitude" class="form-label">Longitude : (optional)</label>
                    <input type="text" class="form-control" id="longitude" name="longitude"
                        value="{{ old('longitude', $restaurant->longitude) }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="rating" class="form-label">Rating : (optional)</label>
                    <input type="text" class="form-control" id="rating" name="rating"
                        value="{{ old('rating', $restaurant->rating) }}">
                </div>
                <div class="form-group">
                    <label for="number" class="form-label">Phone Number : (optional)</label>
                    <input type="text" class="form-control" id="number" name="number"
                        value="{{ old('number', $restaurant->number) }}">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email : (optional)</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $restaurant->email) }}">
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
                        value="{{ old('services', $restaurant->services) }}">
                </div>

                <div class="form-group">
                    <label for="food" class="form-label">Food Rating : (optional)</label>
                    <input type="text" class="form-control" id="food" name="food"
                        value="{{ old('food', $restaurant->food) }}">
                </div>

                <div class="form-group">
                    <label for="value" class="form-label">Value Rating : (optional)</label>
                    <input type="text" class="form-control" id="value" name="value"
                        value="{{ old('value', $restaurant->value) }}">
                </div>

                <div class="form-group">
                    <label for="atmosphere" class="form-label">Atmosphere Rating : (optional)</label>
                    <input type="text" class="form-control" id="atmosphere" name="atmosphere"
                        value="{{ old('atmosphere', $restaurant->atmosphere) }}">
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
            <div class="current-images d-flex flex-wrap gap-2 mb-3">
                @foreach ($restaurant->images as $image)
                    <div class="image-container position-relative" data-image-id="{{ $image->id }}">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Blog image" class="img-thumbnail"
                            style="height: 150px; width: auto;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image"
                            data-image-id="{{ $image->id }}" title="Remove image">
                            <i class="fas fa-times"></i>
                        </button>
                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                    </div>
                @endforeach
            </div>
            {{-- <div class="form-group">
                <label for="images" class="form-label">Additional Images : *</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>

                @if ($restaurant->images->count() > 0)
                    <div class="mt-2">
                        <small class="text-muted">Current images (click delete on individual images to remove
                            them)</small>
                    </div>
                @endif
            </div> --}}
            <br>
            <div class="form-group-buttons">
                <a href="{{ route('restaurants.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Update Restaurant</button>
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
