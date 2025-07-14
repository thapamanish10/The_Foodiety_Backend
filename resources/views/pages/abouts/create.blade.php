@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Provide information about the about information.</p>
        </div>
        <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="formBody">
                <div class="form-group">
                    <label for="name">COMPANY NAME: * </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
                <label for="company_logo">COMPANY LOGO: *</label>
                <div class="form-group-image">
                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*"
                        style="display: none;">
                    <div id="logoPreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                    <div class="image-upload-icon" onclick="document.getElementById('logo').click();">
                        <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton">
                        <span id="fileName">Drop your image here, Or browse</span>
                    </div>
                </div>
                <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
                <div class="row">
                    <div class="form-group">
                        <label for="number">PHONE NUMBER: *</label>
                        <input type="text" name="number" id="number" value="{{ old('number') }}">
                    </div>
                    <div class="form-group">
                        <label for="opt_number">OPT PHONE NUMBER: (OPTIONAL)</label>
                        <input type="text" name="opt_number" id="opt_number" value="{{ old('opt_number') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL ADDRESS: </label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="facebook">FACEBOOK LINK: (OPTIONAL)</label>
                        <input type="text" name="facebook" id="facebook" value="{{ old('facebook_link') }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram">INSTAGRAM LINK: (OPTIONAL)</label>
                        <input type="text" name="instagram" id="instagram" value="{{ old('instagram_link') }}">
                    </div>
                    <div class="form-group">
                        <label for="youtube">YOUTUBE LINK: (OPTIONAL)</label>
                        <input type="text" name="youtube" id="youtube" value="{{ old('youtube_link') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="tiktok">TIKTOK LINK: (OPTIONAL)</label>
                        <input type="text" name="tiktok" id="tiktok" value="{{ old('tiktok_link') }}">
                    </div>
                    <div class="form-group">
                        <label for="threads">THREADS LINK: (OPTIONAL)</label>
                        <input type="text" name="threads" id="threads" value="{{ old('threads_link') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc">COMPANY ABOUT TEXT: *</label>
                    <textarea type="text" cols="30" rows="10" name="desc" id="editor">{{ old('desc') }}</textarea>
                </div>
                <label for="company_logo">COMPANY Images: *</label>
                <div class="form-group-image">
                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*"
                        style="display: none;">
                    <div id="imagePreviews" class="mt-2 d-flex flex-wrap gap-2"></div>
                    <div class="image-upload-icon" onclick="document.getElementById('images').click();">
                        <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt=""
                            id="customButton">
                        <span id="fileName">Drop your image here, Or browse</span>
                    </div>
                </div>
                <div class="form-text" style="padding: 5px 0;">Max size 100MB each (JPEG, PNG, JPG, GIF, WEBP)</div>
            </div>
            <br>
            <div class="form-group-buttons">
                <a href="{{ route('business.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Create About</button>
            </div>
        </form>
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
