@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Edit information about the Service.</p>
        </div>
        <form action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($service))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $service->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $service->title ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="info">Info</label>
                <textarea class="form-control" id="info" name="info" rows="3" required>{{ old('info', $service->info ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="why">Why Choose Us</label>
                <textarea class="form-control" id="why" name="why" rows="5" required>{{ old('why', $service->why ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="5" required>{{ old('desc', $service->desc ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="why2">Additional Why Info (Optional)</label>
                <textarea class="form-control" id="why2" name="why2" rows="3">{{ old('why2', $service->why2 ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="offer">What We Offer</label>
                <textarea class="form-control" id="offer" name="offer" rows="5" required>{{ old('offer', $service->offer ?? '') }}</textarea>
            </div>
            <label for="logo" class="form-label">Service Logo :*</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="logo" name="logo" multiple accept="image/*"
                    style="display: none;">
                <div id="imagelogoPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                @if (isset($service) && $service->logo)
                    <img src="{{ asset('storage/' . $service->logo) }}" width="250" height="150" alt="Current logo"
                        style="object-fit: cover">
                @endif
                <div class="image-upload-icon" onclick="document.getElementById('logo').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            <label for="logo" class="form-label">Service Thumbnail :*</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" multiple accept="image/*"
                    style="display: none;">
                <div id="imageThumbnailPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                @if (isset($service) && $service->thumbnail)
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" width="250" height="150"
                        alt="Current Thumbnail" style="object-fit: cover">
                @endif
                <div class="image-upload-icon" onclick="document.getElementById('thumbnail').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>


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
                <a href="{{ route('services.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Update Service</button>
            </div>
        </form>
    </div>
    <label class="form-label">Current Images</label>
    <div class="current-images">
        @foreach ($service->images as $image)
            <div class="image-container position-relative" data-image-id="{{ $image->id }}">
                <img src="{{ asset('storage/' . $image->path) }}" width="150" height="150" alt="Current Thumbnail"
                    style="object-fit: cover">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image"
                    data-image-id="{{ $image->id }}" title="Remove image">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
            </div>
        @endforeach
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
                        preview.style.height = '150px';

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
            const imageInput = document.getElementById('thumbnail');
            const previewContainer = document.getElementById('imageThumbnailPreviews');
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
                        preview.style.height = '150px';

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
            .create(document.querySelector('#info'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#desc'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#why'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#why2'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#offer'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
