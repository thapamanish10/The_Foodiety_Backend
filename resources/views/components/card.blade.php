@props(['blog', 'views', 'comments', 'likes', 'type'])
<div class="card">
    <a
        href="{{ $type === 'restaurant'
            ? route('home.recipes.show', ['recipe' => $blog->id . '-0-' . Str::slug($blog->name)])
            : route('home.blogs.show', ['blog' => $blog->id . '-0-' . Str::slug($blog->name)]) }}">
    </a>
    <div class="card-image">
        @php
            $imageToShow = $blog->images->first();
            $defaultImage = $type === 'recipe' ? 'default-recipe.jpg' : 'default-blog.jpg';
            $storageFolder = $type === 'recipe' ? 'recipe_images' : 'blog_images';
        @endphp

        @if ($imageToShow && Storage::exists('public/' . $storageFolder . '/' . basename($imageToShow->path)))
            <img src="{{ Storage::url($storageFolder . '/' . basename($imageToShow->path)) }}" alt="{{ $blog->name }}"
                class="blog-image" loading="lazy">
        @else
            <img src="{{ asset('images/' . $defaultImage) }}" alt="{{ $blog->name }}" class="blog-image">
        @endif
    </div>
    <h3 class="card-heading">{{ $blog->name }}</h3>
    <div class="card-info">
        <div class="card-info-sec">
            <div class="card-info-sub-sec">
                <img src="{{ url('/view.png') }}" alt="">
                <span>{{ $views->count() }}</span>
            </div>
            <div class="card-info-sub-sec">
                <img src="{{ url('/message.png') }}" alt="">
                <span>{{ $comments->count() }}</span>
            </div>
        </div>
        <div class="card-info-sec">
            <form action="{{ $type === 'recipe' ? route('recipes.like', $blog) : route('blogs.like', $blog) }}"
                method="POST" class="like-form">
                @csrf
                <button type="submit" class="like-button {{ $blog->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                    <div class="card-info-sub-sec">
                        <span>{{ $likes->count() }}</span>
                        <img src="{{ asset($blog->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                            alt="Like">
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .card-info-sec button {
        background: transparent;
        border: 0;
        outline: 0;
        cursor: pointer;
    }

    .card {
        position: relative;
        flex: 1 1 300px;
        min-height: 350px;
        height: 350px;
        max-height: 350px;
        border: 1px solid #dddddd93;
        display: flex;
        flex-direction: column;

    }

    .card a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 60%;
    }

    .card-image {
        width: 100%;
        height: 60%;
        overflow: hidden;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-heading {
        width: 90%;
        margin: auto;
        padding: 1rem 0;
        font-family: "Playfair Display", serif;
        font-style: italic;
        font-weight: 400;
        color: #5f5f5f;
    }

    .card-info {
        width: 90%;
        position: relative;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #dddddd93;
        padding: 1rem 0;
    }

    .card-info-sec {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card-info-sub-sec {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .card-info-sub-sec img {
        width: 18px;
        height: 18px;
        object-fit: cover;
    }

    .card-info-sub-sec span {
        font-size: 15px;
        font-weight: normal;
        color: #5f5f5f;
    }
</style>
