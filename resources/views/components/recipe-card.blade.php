@props(['recipe', 'views', 'comments', 'likes', 'query' => null])
<div class="recipes-card">
    <a href="{{ route('home.recipes.show', ['recipe' => $recipe->id . '-0-' . $recipe->name]) }}"></a>
    <div class="recipes-card-image">
        @if ($recipe->images->isNotEmpty())
            <div class="recipes-card-image-carousel">
                @foreach ($recipe->images->take(1) as $image)
                    <div class="carousel-slide">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $recipe->name }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/default-recipe.jpg') }}'">
                    </div>
                @endforeach
            </div>
        @elseif ($recipe->image)
            <div class="carousel-slide">
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}"
                    onerror="this.onerror=null;this.src='{{ asset('images/default-recipe.jpg') }}'">
            </div>
        @else
            <div class="no-image">
                <img src="{{ asset('images/default-recipe.jpg') }}" alt="No image available">
            </div>
        @endif
    </div>
    <div class="recipes-card-details">
        <div class="recipes-card-details-top">
            <x-user-info/>
            <div class="recipes-card-heading">
                @if ($query)
                    {!! Str::highlight($recipe->name, $query) !!}
                @else
                    {{ $recipe->name }}
                @endif
            </div>
            <div class="recipes-card-desc">
                @if ($query)
                    {!! Str::highlight(Str::limit($recipe->desc2, 500), $query) !!}
                @else
                    {!! Str::limit($recipe->desc2, 500) !!}
                @endif
            </div>
        </div>
        <div class="recipes-card-info">
            <div class="recipes-card-info-sec">
                <div class="recipes-card-info-sub-sec">
                    <span>{{ $recipe->views->count() }} views</span>
                </div>
                <div class="recipes-card-info-sub-sec">
                    <span>{{ $recipe->comments->count() }} comments</span>
                </div>
            </div>
            <div class="recipes-card-info-sec">
                <form action="{{ route('recipes.like', $recipe) }}" method="POST" class="like-form">
                    @csrf
                    <button type="submit" class="like-button {{ $recipe->isLikedBy(auth()->user()) ? 'liked' : '' }}">
                        <div class="recipes-card-info-sub-sec">
                            <span>{{ $recipe->likes->count() }}</span>
                            <img src="{{ asset($recipe->isLikedBy(auth()->user()) ? 'heart (2).png' : 'heart (1).png') }}"
                                alt="Like">
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..950;1,400..950&display=swap');

    .recipes-card-info-sec button {
        background: transparent;
        border: 0;
        outline: 0;
        cursor: pointer;
    }

    .recipes-card {
        position: relative;
        width: 100%;
        min-height: 800px;
        height: 800px;
        max-height: 800px;
        border: 1px solid #dddddd93;
        margin: 2rem 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;

    }

    .recipes-card a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
    }

    .recipes-card-image {
        width: 100%;
        height: 50%;
    }

    .recipes-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .recipes-card-details{
         width: 95%;
         margin: auto;
        height: 50%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .recipes-card:hover .recipes-card-heading {
        color: #ffd000;
    }

    .recipes-card-heading {
        padding: 1rem 0;
        font-size: 27px;
        font-family: "Playfair Display", serif;
        font-style: italic;
        font-weight: 400;
        color: #5f5f5f;
    }

    .recipes-card p {
        font-size: 15px;
        font-weight: 400;
        text-align: justify;
        color: #5f5f5f;
    }

    .recipes-card-desc::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.5em;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
        z-index: 1;
    }

    .recipes-card-info {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        border-top: 1px solid #dddddd93;
        z-index: 5;
        padding-top: 1.5rem;
    }

    .recipes-card-info-sec {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .recipes-card-info-sub-sec {
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    
    .recipes-card-info-sec form{
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center
    }
    .recipes-card-info-sec form button{
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center
    }
    .recipes-card-info-sub-sec img {
        width: 18px;
        height: 18px;
        object-fit: cover;
    }

    .recipes-card-info-sub-sec span {
        font-size: 14px;
        font-weight: 500;
        font-weight: normal;
        color: #5f5f5f;
    }
</style>
