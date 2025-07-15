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
    <div class="recipes-card-user-info">
        <img src="{{ url('foodiety.png') }}" alt="" class="recipes-card-user-image">
        <div class="recipes-card-user-info-user-details">
            <h3>The Foodiety</h3>
            <span>{{ $recipe->created_at->format('d M') }}</span>
        </div>
        <img src="{{ url('/share.png') }}" alt="" class="recipes-card-share">
    </div>
    <h2 class="recipes-card-heading">
        @if ($query)
            {!! Str::highlight($recipe->name, $query) !!}
        @else
            {{ $recipe->name }}
        @endif
    </h2>

    <p class="recipes-card-desc">
        @if ($query)
            {!! Str::highlight(Str::limit($recipe->desc, 500), $query) !!}
        @else
            {!! Str::limit($recipe->desc, 500) !!}
        @endif
    </p>
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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

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
        margin-bottom: 1rem;
    }

    .recipes-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }


    .recipes-card-user-info {
        width: 93%;
        margin: auto;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 5;
        margin-bottom: 1.5rem;
    }

    .recipes-card-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 1.5px solid #ffde59;
        padding: .1rem;
    }

    .recipes-card-user-info-user-details h3 {
        font-size: 16px;
        font-weight: 600;
        color: #5f5f5f;
        text-transform: uppercase;
    }

    .recipes-card-user-info-user-details span {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
    }

    .recipes-card-share {
        position: absolute;
        top: 50%;
        right: 0%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
    }

    .recipes-card:hover .recipes-card-heading {
        color: #ffd000;
    }

    .recipes-card-heading {
        width: 90%;
        margin: auto;
        padding: 1rem 0;
        font-size: 27px;
        font-family: "Playfair Display", serif;
        font-style: italic;
        font-weight: 400;
        color: #5f5f5f;
    }

    .recipes-card p {
        width: 90%;
        margin: auto;
        font-size: 15px;
        font-weight: 400;
        text-align: justify;
        color: #5f5f5f;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        max-height: calc(1.5em * 5);
        position: relative;
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
        position: absolute;
        left: 5%;
        bottom: 3%;
        width: 90%;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 0 0 0;
        border-top: 1px solid #dddddd93;
        z-index: 5;
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

    @media (max-width: 600px) {
        .recipes-card {
            position: relative;
            width: 100%;
            margin: auto;
            min-height: 650px;
            height: 650px;
            max-height: 650px;
            border: 1px solid #dddddd93;
            display: block;
            align-items: flex-start;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .recipes-card-image {
            width: 100%;
            min-width: 100%;
            height: 50%;
            position: relative;
            overflow: hidden;
        }

        .recipes-content {
            height: 100%;
            padding: 0;
            position: relative;
            width: 90%;
            margin: 1rem auto;

        }

        .recipes-card-user-info {
            width: 90%;
            display: flex;
            gap: 1rem;
            position: relative;
            z-index: 5;
        }

        .recipes-card-user-image {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;
            border: 1.5px solid #ffde59;
            padding: .1rem;
        }

        .recipes-card-user-info-user-details h3 {
            font-size: 13px;
            font-weight: 600;
            color: #5f5f5f;
            text-transform: uppercase;
            margin-bottom: 0;
            margin-top: 0;
        }

        .recipes-card-user-info-user-details p {
            font-size: 10px;
            font-weight: 500;
            color: #5f5f5f;
            margin-top: .3rem;
            margin-bottom: 0;
        }

        .recipes-card-share {
            position: absolute;
            top: 50%;
            right: 0%;
            transform: translate(0%, -50%);
            width: 20px;
            height: 20px;
        }

        .recipes-card-heading {
            width: 90%;
            margin: 1rem auto;
            padding: 0;
            font-family: "Playfair Display", serif !important;
            font-size: 24px;
            font-weight: 400;
            color: #5f5f5f;
        }

        .recipes-card-desc {
            width: 90%;
            margin: 1rem auto;
            padding: 0 0;
            font-size: 14px;
            font-weight: 400;
            text-align: justify;
            color: #5f5f5f;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
            max-height: calc(1.5em * 3);
            position: relative;
        }

        .recipes-card-info {
            position: absolute;
            left: 5%;
            bottom: 3%;
            width: 90%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0 0 0;
            border-top: 1px solid #dddddd93;
            z-index: 5;
        }
    }
</style>
