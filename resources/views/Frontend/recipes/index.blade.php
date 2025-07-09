@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Foodiety Recipes" />
    <section class="blog-index-div">
        <x-main-sub-heading title="All My Blogs" type="recipe" />
        @forelse ($recipes as $recipe)
            <x-recipe-card :recipe="$recipe" :views="$recipe->views_count" :comments="$recipe->comments_count" :likes="$recipe->likes_count" />
        @empty
            <span class="no-blogs">No recipes found</span>
        @endforelse
    </section>
@endsection

<style>
    .blog-index-div {
        width: 50%;
        margin: auto;
    }

    .no-blogs {
        display: block;
        text-align: center;
        padding: 2rem;
        color: #5f5f5f;
    }

    @media (max-width: 600px) {
        .blog-index-div {
            width: 100%;
            margin: auto;
        }
    }
</style>
