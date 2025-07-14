@extends('pages.home')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>{{ $service->name }}</h1>
            </div>
            <div class="card-body">
                @if ($service->thumbnail)
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" class="img-fluid mb-3" alt="Service Thumbnail">
                @endif

                <h2>{{ $service->title }}</h2>
                <p class="lead">{{ $service->info }}</p>

                <div class="mb-4">
                    <h3>Description</h3>
                    <p>{{ $service->desc }}</p>
                </div>

                <div class="mb-4">
                    <h3>Why Choose Us</h3>
                    <p>{{ $service->why }}</p>
                    @if ($service->why2)
                        <p>{{ $service->why2 }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <h3>What We Offer</h3>
                    <p>{{ $service->offer }}</p>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
