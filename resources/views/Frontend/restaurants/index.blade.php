@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Restaurants" />
    <section class="restaurant-index-div">
        <x-main-sub-heading title="All Restaurants" type="blog" />
        @forelse ($restaurants as $restaurant)
            <x-restaurant-card :restaurant="$restaurant" :views="$restaurant->views_count" :comments="$restaurant->comments_count" :likes="$restaurant->likes_count" />
        @empty
            <span class="no-restaurants">No blogs found</span>
        @endforelse
    </section>
@endsection

<style>
    .restaurant-index-div {
        width: 55%;
        margin: auto;
    }

    .no-restaurants {
        display: block;
        text-align: center;
        padding: 2rem;
        color: #5f5f5f;
    }

    @media (max-width: 1200px) {
        .restaurant-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .restaurant-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .restaurant-index-div {
            width: 100%;
            margin: auto;
        }
    }
</style>
