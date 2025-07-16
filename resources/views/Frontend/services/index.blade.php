@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Foodiety Services" />
    <section class="services-index-div">
        <x-main-sub-heading title="All My Blogs" type="blog" />
        <div class="card3-container">
            @forelse ($Services as $service)
                <x-card3 :service="$service" :even="$loop->even" />
            @empty
                <span class="no-servicess">No blogs found</span>
            @endforelse
        </div>
    </section>
@endsection

<style>
    .services-index-div {
        width: 55%;
        margin: auto;
    }

    .no-servicess {
        display: block;
        text-align: center;
        padding: 2rem;
        color: #5f5f5f;
    }

    .card3-container {
        display: flex;
        flex-direction: column;
        gap: 30px;
        margin-top: 30px;
    }

    @media (max-width: 1200px) {
        .services-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .services-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .services-index-div {
            width: 100%;
            margin: auto;
        }
    }
</style>
