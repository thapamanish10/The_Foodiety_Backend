@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Provide information about the Restaurant.</p>
        </div>

        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            <div class="form-group">
                <label for="name">Name :*</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $service->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="title">Title :*</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $service->title ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="info">Info :*</label>
                <textarea type="text" cols="30" rows="10" name="info" id="info">{{ old('info') }}</textarea>
            </div>
            <div class="form-group">
                <label for="why">Why Choose Us :*</label>
                <textarea type="text" cols="30" rows="10" name="why" id="why">{{ old('why') }}</textarea>
            </div>
            <div class="form-group">
                <label for="desc">Description :*</label>
                <textarea type="text" cols="30" rows="10" name="desc" id="desc">{{ old('desc') }}</textarea>
            </div>
            <div class="form-group">
                <label for="why2">Additional Why Info (Optional) :*</label>
                <textarea type="text" cols="30" rows="10" name="why2" id="why2">{{ old('why2') }}</textarea>
            </div>
            <div class="form-group">
                <label for="offer">What We Offer :*</label>
                <textarea type="text" cols="30" rows="10" name="offer" id="offer">{{ old('offer') }}</textarea>
            </div>
            <label for="logo" class="form-label">Logo :*</label>
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
            <label for="logo" class="form-label">Thumbnail :*</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" multiple accept="image/*"
                    style="display: none;">
                <div id="imageThumbnailPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('thumbnail').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            <label for="logo" class="form-label">Additional Images :*</label>
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
            <div class="form-group-buttons">
                <a href="{{ route('services.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Create Service</button>
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
