@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading">
            <h3>Fill up the Information:</h3>
            <p>{{ isset($category) ? 'Edit' : 'Create' }} information about the Category.</p>
        </div>

        <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}"
            method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $category->name ?? '') }}" required>
            </div>
            <br>
            <div class="form-group-buttons">
                <a href="{{ route('categories.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" id="submitButton" class="btn-primary">Update Category</button>
            </div>
        </form>
    </div>
@endsection
