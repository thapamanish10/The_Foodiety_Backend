@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Edit information about the Image.</p>
        </div>

        <form action="{{ route('galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $gallery->name }}"
                    required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Image Desc</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ $gallery->description }}" required>
            </div>
            <label for="image" class="form-label">Image</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                    style="display: none;">
                <div id="imagePreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}" class="img-thumbnail mb-2"
                    style="max-height: 150px;">
                <div class="image-upload-icon" onclick="document.getElementById('image').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">

                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            <div class="form-group-buttons">
                <a href="{{ route('blogs.index') }}" class=" btn-secondary">Cancel</a>
                <button type="submit" class=" btn-primary">Update Image</button>
            </div>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('image');
                const previewContainer = document.getElementById('imagePreviews');
                const maxFiles = 20; // Set maximum number of image
                let selectedFiles = [];

                // Handle file selection
                imageInput.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);

                    // Check total files won't exceed max
                    if (selectedFiles.length + files.length > maxFiles) {
                        alert(`You can upload a maximum of ${maxFiles} image`);
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
    </div>
@endsection
