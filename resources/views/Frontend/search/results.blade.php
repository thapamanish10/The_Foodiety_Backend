@extends('Frontend.layouts.main')

@section('content')
    @if ($searchType === 'blog')
        <x-main-heading title="Blog Results for: {{ $query }}" />
    @elseif($searchType === 'recipe')
        <x-main-heading title="Recipe Results for: {{ $query }}" />
    @else
        <x-main-heading title="Search Results for: {{ $query }}" />
    @endif
    <section class="search-results">
        @if ($blogs->count() > 0 || $recipes->count() > 0)
            @if ($blogs->count() > 0)
                <x-main-sub-heading title="Blogs" />
                <div class="blog-results">
                    @foreach ($blogs as $blog)
                        <x-card2 :blog="$blog" :views="$blog->views_count" :comments="$blog->comments_count" :likes="$blog->likes_count"
                            :query="$query ?? null" />
                    @endforeach
                </div>
            @endif

            @if ($recipes->count() > 0)
                <x-main-sub-heading title="Recipes" />
                <div class="recipe-results">
                    @foreach ($recipes as $recipe)
                        <x-recipe-card :recipe="$recipe" :query="$query ?? null" />
                    @endforeach
                </div>
            @endif
        @else
            <div class="no-results">
                <p>No results found @if (isset($query) && $query)
                        for "{{ $query }}"
                    @endif
                </p>
            </div>
        @endif
    </section>
@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .search-results {
        width: 55%;
        margin: auto;
    }

    .blog-results,
    .recipe-results {
        margin-bottom: 2rem;
    }

    .no-results {
        text-align: center;
        padding: 2rem;
        color: #5f5f5f;
    }

    /* Highlight class for searched terms */
    .highlight {
        background-color: #ffde5975;
        padding: 0 5px;
        color: #5f5f5f;
        font-family: "Playfair Display", serif !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const query = "{{ $query }}";
        if (query) {
            // Highlight text in blog cards
            document.querySelectorAll('.blog-results .card-content').forEach(element => {
                highlightText(element, query);
            });

            // Highlight text in recipe cards
            document.querySelectorAll('.recipe-results .card-content').forEach(element => {
                highlightText(element, query);
            });
        }
    });

    function highlightText(element, query) {
        const text = element.innerHTML;
        const regex = new RegExp(query, 'gi');
        const highlightedText = text.replace(regex, match =>
            `<span class="highlight">${match}</span>`
        );
        element.innerHTML = highlightedText;
    }
</script>
