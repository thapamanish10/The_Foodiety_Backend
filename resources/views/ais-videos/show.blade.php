@extends('pages.home')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $ai_video->name }}</h2>
                <div>
                    <a href="{{ route('videos.download', $ai_video) }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Download
                    </a>
                    @auth
                        <a href="{{ route('videos.edit', $ai_video) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    @endauth
                </div>
            </div>

            <div class="card-body">
                @if ($ai_video->desc)
                    <p class="lead">{{ $ai_video->desc }}</p>
                @endif

                <div class="ratio ratio-16x9 mb-4">
                    <video controls class="rounded">
                        <source src="{{ asset('storage/' . $ai_video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Videos
                    </a>

                    @auth
                        <form action="{{ route('videos.destroy', $ai_video) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this video?')">
                                <i class="fas fa-trash"></i> Delete Video
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
