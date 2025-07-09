@php
    $restaurants = \App\Models\Restaurant::with(['images'])
        ->withCount(['likes', 'comments', 'views'])
        ->take(3)
        ->get();
@endphp

<section class="recommended-main-div">
    @forelse ($restaurants as $restaurant)
        <x-restaurant-card :restaurant="$restaurant" :views="$restaurant->views_count" :comments="$restaurant->comments_count" :likes="$restaurant->likes_count" />
    @empty
        <span class="no-restaurants">No blogs found</span>
    @endforelse
</section>
