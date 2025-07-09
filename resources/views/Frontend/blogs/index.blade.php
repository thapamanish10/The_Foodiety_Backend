@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Foodiety Blogs" />
    <section class="blog-index-div">
        <x-main-sub-heading title="All My Blogs" type="blog" />
        @forelse ($blogs as $blog)
            <x-card2 :blog="$blog" :views="$blog->views_count" :comments="$blog->comments_count" :likes="$blog->likes_count" />
        @empty
            <span class="no-blogs">No blogs found</span>
        @endforelse
    </section>
@endsection

<style>
    .blog-index-div {
        width: 55%;
        margin: auto;
    }

    .no-blogs {
        display: block;
        text-align: center;
        padding: 2rem;
        color: #5f5f5f;
    }

    @media (max-width: 1200px) {
        .blog-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .blog-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .blog-index-div {
            width: 100%;
            margin: auto;
        }
    }
</style>
