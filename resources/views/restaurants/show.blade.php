@extends('pages.home')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $restaurant->name }}</h1>
            <div>
                <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                @if ($restaurant->logo)
                    <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}"
                        class="img-fluid mb-3">
                @endif

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> <span
                                class="badge bg-{{ $restaurant->status === 'public' ? 'success' : 'warning' }}">{{ ucfirst($restaurant->status) }}</span>
                        </p>
                        <p><strong>Published:</strong> {{ $restaurant->publish_at }}</p>
                        <p><strong>Phone:</strong> {{ $restaurant->number ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $restaurant->email ?? 'N/A' }}</p>
                        <p><strong>Rating:</strong> {{ $restaurant->rating ?? 'N/A' }}</p>

                        @if ($restaurant->latitude && $restaurant->longitude)
                            <p><strong>Location:</strong> {{ $restaurant->latitude }}, {{ $restaurant->longitude }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Description</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $restaurant->desc }}</p>
                        <p>{{ $restaurant->desc2 }}</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Features</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Services:</strong> {{ $restaurant->services ?? 'N/A' }}</p>
                        <p><strong>Food Type:</strong> {{ $restaurant->food ?? 'N/A' }}</p>
                        <p><strong>Value:</strong> {{ $restaurant->value ?? 'N/A' }}</p>
                        <p><strong>Atmosphere:</strong> {{ $restaurant->atmosphere ?? 'N/A' }}</p>
                    </div>
                </div>

                @if ($restaurant->images->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Gallery</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($restaurant->images as $image)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Restaurant Image"
                                            class="img-fluid">
                                        <form action="{{ route('restaurants.destroyImage', $image->id) }}" method="POST"
                                            class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this image?')">Delete</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
