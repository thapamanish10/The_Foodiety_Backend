@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>Edit information about the Recipe post.</p>
        </div>

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Title</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $recipe->name) }}" required>
            </div>
            <div class="form-group">
                <label for="desc" class="form-label">Content</label>
                <textarea class="form-control" id="editor" name="desc" rows="5" required>{{ old('desc', $recipe->desc) }}</textarea>
            </div>
            <div class="form-group">
                <label for="desc2" class="form-label">Content 2</label>
                <textarea class="form-control" id="editor1" name="desc2" rows="5" required>{{ old('desc2', $recipe->desc2) }}</textarea>
            </div>

            <label for="images" class="form-label">Recipe Images</label>
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

            <div class="row">
                <div class="form-group">
                    <label for="publish_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" class="form-control" id="publish_at" name="publish_at"
                        value="{{ old('publish_at', $recipe->publish_at) }}" required>
                </div>
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="public" {{ $recipe->status === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ $recipe->status === 'private' ? 'selected' : '' }}>Private</option>
                        <option value="draft" {{ $recipe->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Categories (optional)</label>
                <div class="category-checkboxes">
                    @foreach ($categories as $category)
                        <div class="custom-checkbox">
                            <input type="checkbox" id="category-{{ $category->id }}" name="categories[]"
                                value="{{ $category->id }}"
                                {{ $recipe->categories->contains($category->id) ? 'checked' : '' }}
                                class="custom-checkbox-input">
                            <label for="category-{{ $category->id }}" class="custom-checkbox-label">
                                <span class="custom-checkbox-button"></span>
                                <span class="custom-checkbox-text">{{ $category->name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group-buttons">
                <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class=" btn-primary">Update Recipe</button>
            </div>
        </form>
    </div>

    <label class="form-label">Current Images</label>
    <div class="current-images d-flex flex-wrap gap-2 mb-3">
        @foreach ($recipe->images as $image)
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('imagePreviews');
            const maxFiles = 5; // Set maximum number of images
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

                    // 20MB in bytes (20 * 1024 * 1024)
                    if (file.size > 20971520) {
                        alert(`${file.name} is too large (max 20MB)`);
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
                        <img src="{{ url('close.png') }}"/>
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
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
