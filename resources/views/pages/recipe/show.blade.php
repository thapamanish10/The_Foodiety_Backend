@extends('pages.home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ $recipe->name }}</h1>

                @if ($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="recipe image" class="img-fluid mb-4">
                @endif

                <div class="meta mb-4">
                    <span class="text-muted">Published: {{ $recipe->publish_at->format('M d, Y') }}</span>
                    <span class="mx-2">•</span>
                    <span class="text-muted">Views: {{ $viewCount }}</span>
                </div>

                <div class="content">
                    {!! nl2br(e($recipe->desc)) !!}
                </div>

                <div class="engagement mt-5">
                    <form action="{{ route('recipes.like', $recipe->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $isLiked ? 'btn-danger' : 'btn-outline-danger' }}">
                            <i class="fas fa-heart"></i> Like ({{ $likeCount }})
                        </button>
                    </form>

                    <div class="share-buttons mt-3">
                        <a href="{{ $shareLinks['facebook'] }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fab fa-facebook"></i> Share
                        </a>
                        <a href="{{ $shareLinks['twitter'] }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fab fa-twitter"></i> Tweet
                        </a>
                        <button onclick="copyToClipboard('{{ $shareLinks['copy_link'] }}')"
                            class="btn btn-sm btn-secondary">
                            <i class="fas fa-copy"></i> Copy Link
                        </button>
                    </div>
                </div>

                <div class="comments mt-5">
                    <h3>Comments</h3>

                    <form action="{{ route('recipes.comment', $recipe->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" placeholder="Add a comment..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>

                    <div class="comment-list mt-4">
                        @foreach ($comments as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                                    <p class="card-text">{{ $comment->content }}</p>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Link copied to clipboard!');
            });
        }
    </script>
@endsection
