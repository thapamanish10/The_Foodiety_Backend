@extends('pages.home')

@section('content')
    <div class="container">

        <div class="card">

            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" alt="{{ $gallery->name }}">
            <div class="card-body">
                <h1 class="card-title">{{ $gallery->name }}</h1>
                @if ($gallery->description)
                    <p class="card-text">{{ $gallery->description }}</p>
                @endif
                <a href="{{ route('galleries.download', $gallery) }}" class="btn btn-success">Download</a>
                <a href="{{ route('galleries.edit', $gallery) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back to Gallery</a>
            </div>
        </div>
    </div>
@endsection
