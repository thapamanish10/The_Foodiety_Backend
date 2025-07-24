@php
    $recipes = \App\Models\Recipe::withCount(['likes', 'comments', 'views', 'images'])
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
@endphp
<div class="home-recipe-container">
    @forelse ($recipes as   $recipe)
        <x-card :blog="$recipe" :views="$recipe->views" :comments="$recipe->comments" :likes="$recipe->likes" type="recipe" />
    @empty
        <p>no recipes found</p>
    @endforelse
    <x-card-link route="home.recipes.index" />
</div>
<style>
    .home-recipe-container {
        width: 100%;
        margin: auto;
        height: fit-content;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        padding: 20px 0;
    }

    @media (max-width: 1200px) {
        .home-recipe-container {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .home-recipe-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .home-recipe-container {
            grid-template-columns: repeat(2, 1fr);
            gap: .5rem;
        }
    }
</style>
