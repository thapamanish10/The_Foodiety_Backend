@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Edit information about the about Details.</p>
        </div>
        <form action="{{ route('business.update', $about->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">COMPANY NAME: *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $about->name) }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Logo Upload -->

            <label for="images" class="form-label">COMPANY LOGO: *</label>
            <div class="form-group-image">
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*"
                    style="display: none;">
                @if ($about->logo)
                    <img src="{{ Storage::url($about->logo) }}" class="preview-image" id="logoPreview"
                        style="object-fit: contain" width="150">
                @endif
                <div id="logoPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                <div class="image-upload-icon" onclick="document.getElementById('logo').click();">
                    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                    <span id="fileName">Drop your image here, Or browse</span>
                </div>
            </div>
            <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>


            <!-- Contact Information Row -->
            <div class="row">
                <div class="form-group">
                    <label for="number">PHONE NUMBER: *</label>
                    <input type="tel" name="number" id="number" value="{{ old('number', $about->number) }}"
                        required>
                    @error('number')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="opt_number">OPT PHONE NUMBER:</label>
                    <input type="tel" name="opt_number" id="opt_number"
                        value="{{ old('opt_number', $about->opt_number) }}">
                </div>

                <div class="form-group">
                    <label for="email">EMAIL ADDRESS: *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $about->email) }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Social Media Row 1 -->
            <div class="row">
                <div class="form-group">
                    <label for="facebook">FACEBOOK LINK:</label>
                    <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $about->facebook) }}">
                    @error('facebook')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instagram">INSTAGRAM LINK:</label>
                    <input type="url" name="instagram" id="instagram"
                        value="{{ old('instagram', $about->instagram) }}">
                    @error('instagram')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="youtube">YOUTUBE LINK:</label>
                    <input type="url" name="youtube" id="youtube" value="{{ old('youtube', $about->youtube) }}">
                    @error('youtube')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Social Media Row 2 -->
            <div class="row">
                <div class="form-group">
                    <label for="tiktok">TIKTOK LINK:</label>
                    <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok', $about->tiktok) }}">
                    @error('tiktok')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="threads">threads LINK:</label>
                    <input type="url" name="threads" id="threads" value="{{ old('threads', $about->threads) }}">
                    @error('threads')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Company Description -->
            <div class="form-group">
                <label for="description">COMPANY ABOUT TEXT: *</label>
                <textarea name="desc" id="editor" required>{{ old('desc', $about->desc) }}</textarea>
                @error('desc')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <label for="images" class="form-label">COMPANY IMAGES:</label>
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
                <a href="{{ route('business.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update About</button>
            </div>
        </form>
        <!-- Image Previews -->
        <div class="image-previews" id="imagePreviews">
            @foreach ($about->images as $image)
                <div class="image-preview" data-id="{{ $image->id }}">
                    <img src="{{ Storage::url($image->path) }}">
                    <button type="button" class="remove-image" data-id="{{ $image->id }}">×</button>
                    <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                </div>
            @endforeach
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('logo');
        const previewContainer = document.getElementById('logoPreviews');
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
