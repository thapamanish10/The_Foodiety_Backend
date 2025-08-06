@php
    $blogs = \App\Models\Blog::withCount(['likes', 'comments', 'views', 'images'])
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
@endphp
<div class="recent-blog-container">
    @forelse ($blogs as   $blog)
        <x-card :blog="$blog" :views="$blog->views" :comments="$blog->comments" :likes="$blog->likes" />
    @empty
        <p>no blogs found</p>
    @endforelse
</div>
<style>
    .recent-blog-container {
        width: 100%;
        margin: auto;
        height: fit-content;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 20px 0;
    }

    @media (max-width: 1200px) {
        .recent-blog-container {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .recent-blog-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .recent-blog-container {
            grid-template-columns: repeat(2, 1fr);
            gap: .5rem;
            padding: 0;
        }
    }
</style>
