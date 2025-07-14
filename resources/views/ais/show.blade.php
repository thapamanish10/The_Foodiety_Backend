@extends('pages.home')

@section('content')
    <div class="container">

        <div class="card">

            <img src="{{ asset('storage/' . $ai->image) }}" class="card-img-top" alt="{{ $ai->name }}">
            <div class="card-body">
                <h1 class="card-title">{{ $ai->name }}</h1>
                @if ($gallery->description)
                    <p class="card-text">{{ $ai->description }}</p>
                @endif
                <a href="{{ route('galleries.download', $ai) }}" class="btn btn-success">Download</a>
                <a href="{{ route('galleries.edit', $ai) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('galleries.destroy', $ai) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back to Gallery</a>
            </div>
        </div>
    </div>
@endsection
