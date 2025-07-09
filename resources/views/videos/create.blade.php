@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Provide information about the Video.</p>
        </div>

        <form method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data" id="blogForm">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label"> Name : *</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group mb-3">
                <label for="desc" class="form-label">Video Desc : *</label>
                <input type="text" class="form-control" id="desc" name="desc" required>
            </div>
            {{-- Video upload section --}}
            <label for="thumbnail_path" class="form-label">Video : *</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="video" name="video_path" accept="video/*"
                    style="display: none;">
                <div id="videoPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('video').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadvideo" alt="" id="customVideoButton">
                    <span id="videoFileName">Drop your video here, or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max 50MB. Supported formats: MP4, MOV, AVI</div>

            {{-- Image upload section --}}
            <label for="thumbnail_path" class="form-label">Thumbnail Image : *</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="image" name="thumbnail_path" accept="image/*"
                    style="display: none;">
                <div id="imagePreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('image').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            <div class="form-group-buttons">
                <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Upload Video</button>
            </div>
        </form>
    </div>
    {{-- Image Upload Script --}}
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
    {{-- Video Upload Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Video Upload Handling
            const videoInput = document.getElementById('video');
            const videoPreviewContainer = document.getElementById('videoPreviews');
            const maxVideoSize = 100 * 1024 * 1024; // 100MB
            let selectedVideos = [];

            // Handle video selection
            videoInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);

                files.forEach(file => {
                    // Validate file type
                    if (!file.type.match('video.*')) {
                        alert(`${file.name} is not a video file`);
                        return;
                    }

                    // Validate file size
                    if (file.size > maxVideoSize) {
                        alert(`${file.name} is too large (max 100MB)`);
                        return;
                    }

                    // Add to selected videos (assuming single video upload)
                    selectedVideos = [file]; // Reset array for single file

                    // Create preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        videoPreviewContainer.innerHTML = ''; // Clear previous preview

                        const preview = document.createElement('div');
                        preview.className = 'video-preview position-relative';
                        preview.style.width = '300px';

                        preview.innerHTML = `
                                    <video controls class="img-thumbnail" style="width:100%; height:auto;">
                                        <source src="${e.target.result}" type="${file.type}">
                                        Your browser does not support the video tag.
                                    </video>
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-video">
                                        ×
                                    </button>
                                    <div class="video-info">
                                        <p>${file.name}</p>
                                        <p>${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                                    </div>
                                `;

                        videoPreviewContainer.appendChild(preview);

                        // Add remove functionality
                        preview.querySelector('.remove-video').addEventListener('click',
                            function() {
                                preview.remove();
                                selectedVideos = [];
                                updateVideoInput();
                            });
                    };
                    reader.readAsDataURL(file);
                });

                updateVideoInput();
            });

            // Update the actual video input
            function updateVideoInput() {
                const dataTransfer = new DataTransfer();
                selectedVideos.forEach(file => dataTransfer.items.add(file));
                videoInput.files = dataTransfer.files;

                // Update filename display
                const fileNameDisplay = document.getElementById('videoFileName');
                if (selectedVideos.length > 0) {
                    fileNameDisplay.textContent = selectedVideos[0].name;
                } else {
                    fileNameDisplay.textContent = 'Drop your video here, or browse';
                }
            }

            // Drag and drop functionality
            const videoUploadArea = document.querySelector('.video-upload-icon');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                videoUploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                videoUploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                videoUploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                videoUploadArea.classList.add('highlight');
            }

            function unhighlight() {
                videoUploadArea.classList.remove('highlight');
            }

            videoUploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                videoInput.files = files;
                const event = new Event('change');
                videoInput.dispatchEvent(event);
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
