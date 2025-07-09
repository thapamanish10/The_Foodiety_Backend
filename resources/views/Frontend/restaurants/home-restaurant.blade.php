<div class="home-restaurant-container">
    @forelse ($restaurants as $restaurant)
        <x-restaurant-card :restaurant="$restaurant" :views="$restaurant->views_count" :comments="$restaurant->comments_count" :likes="$restaurant->likes_count" />
    @empty
        <span class="no-restaurants">No blogs found</span>
    @endforelse
</div>
<style>
    /* .home-restaurant-container {
        width: 100%;
        margin: auto;
        height: fit-content;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        padding: 20px 0;
    }

    @media (max-width: 1200px) {
        .home-restaurant-container {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .home-restaurant-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .home-restaurant-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }
    } */
</style>
