@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Foodiety Recipes" />
    <section class="blog-index-div">
        <x-main-sub-heading title="All My Recipes" type="recipe" />
        <div class="blog-filter-container">
            <form method="GET" action="{{ route('home.recipes.index') }}" id="categoryFilterForm">
                <div class="category-checkboxes">
                    @foreach($categories as $category)
                        <div class="custom-checkbox">
                            <input type="checkbox" 
                                id="category-{{ $category->id }}"
                                name="categories[]" 
                                value="{{ $category->slug }}"
                                {{ in_array($category->slug, request('categories', [])) ? 'checked' : '' }}
                                onchange="document.getElementById('categoryFilterForm').submit()"
                                class="custom-checkbox-input">
                            <label for="category-{{ $category->id }}" class="custom-checkbox-label">
                                <span class="custom-checkbox-text">{{ $category->name }}</span>
                            </label>
                        </div>
                    @endforeach
                    @if(request('categories'))
                        <a href="{{ route('home.recipes.index') }}"  class="custom-checkbox-label">
                            Clear All
                        </a>
                    @endif
                </div>
            </form>
        </div>
        @forelse ($recipes as $recipe)
            <x-recipe-card :recipe="$recipe" :views="$recipe->views_count" :comments="$recipe->comments_count" :likes="$recipe->likes_count" />
        @empty
            <span class="no-recipes">No recipes found</span>
        @endforelse
    </section>
@endsection

<style>
    .blog-index-div {
        width: 50%;
        margin: auto;
    }

    .no-recipes {
        display: block;
        text-align: center;
        padding: 2rem;
        color: #5f5f5f;
    }

    .blog-filter-container {
        border-radius: 8px;
        flex-wrap: wrap;
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .filter-header h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .clear-filter {
        color: #e74c3c;
        text-decoration: none;
        font-size: 14px;
    }

    .clear-filter:hover {
        text-decoration: underline;
    }

    .category-checkboxes {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .custom-checkbox {
        position: relative;
    }

    .custom-checkbox-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

.custom-checkbox-label {
        display: inline-block;
        padding: .5rem 1.5rem;
        border-top: 1px solid #bebebe28;
        border-left: 1px solid #bebebe28;
        border-right: 1px solid #bebebe28;
        border-bottom: 2px solid #bebebe28;
        background-color:  transparent;
        color: #5f5f5f;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
        text-decoration: none;
        font-family: "Playfair Display", serif;
        white-space: nowrap;
        border-radius: .4rem;
    }

    .custom-checkbox-input:checked + .custom-checkbox-label {
        color: #5f5f5f;
        border-bottom: 2px solid #ffde59;
    }

    .custom-checkbox-label:hover {
        border-bottom: 2px solid #ffde59;
    }

    .custom-checkbox-input:checked + .custom-checkbox-label:hover {
        border-bottom: 2px solid #ffde59;
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
        .blog-filter-container {
            width: 100%;
            padding: auto;
            border-radius: 8px;
        }
        .category-checkboxes {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            padding: 15px;
            gap: 5px;
        }
    }
</style>
