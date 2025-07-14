@extends('Frontend.layouts.main')

@section('content')
@include('Frontend.carousel.index', ['carousels'=> $carousels])
        <x-heading title="Our Story" />
    @include('Frontend.pages.about.index')
     <div class="welcome-container-sections">
        <x-heading title="Our Services" />
        @include('Frontend.services.home-service')
     </div>
    <div class="welcome-container-sections">
        <x-heading title="Recommended Picks" />
        {{-- @include('Frontend.restaurants.home-restaurant') --}}
    </div>
    @include('Frontend.pages.contact.index')
    <div class="welcome-container-sections">
        <x-heading title="Blogs" />
        @include('Frontend.blogs.home-blog')
        <x-heading title="Recipes" />
        @include('Frontend.recipes.home-recipe')
    </div>
@endsection
<style>
    .welcome-container-sections{
        width:65%;
        margin: auto;
    }
    @media (max-width: 1200px) {
        .welcome-container-sections{
            width:65%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .welcome-container-sections{
            width:65%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .welcome-container-sections{
            width:100%;
            margin: auto;
        }
    }
</style>