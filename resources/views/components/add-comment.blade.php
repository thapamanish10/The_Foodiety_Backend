@props(['comments', 'blog_id'])
<section class="add-comment-main-div">
    <div class="add-comment-main-div-heading">
        <h3>Comments</h3>
    </div>
    <div class="add-comment-main-div-body">
        <form action="{{ 
            $type === 'recipe' ? route('recipes.comment', $blog_id) : 
            ($type === 'restaurant' ? route('restaurants.comment', $blog_id) : 
            route('blogs.comment', $blog_id)) 
        }}" method="POST">
            @csrf
            <textarea name="content" cols="30" rows="10" placeholder="Write a comment ..."></textarea>
            <input type="hidden" name="parent_id" value="{{ $parentId ?? null }}">
            <div class="add-comment-main-div-body-sub-section">
                @guest
                    <p>Log in to publish as a member</p>
                @endguest
                <div class="add-comment-main-div-body-sub-section-btns">
                    <button type="button" class="cancle">Cancel</button>
                    <button type="submit" class="publish" @guest disabled @endguest>Publish</button>
                </div>
            </div>
        </form>
    </div>
    @foreach ($comments as $comment)
        <x-comment :comment="$comment" />

        {{-- @if ($comment->replies->isNotEmpty())
            <div class="replies-container">
                @foreach ($comment->replies as $reply)
                    <x-comment :comment="$reply" />
                @endforeach
            </div>
        @endif --}}
    @endforeach
</section>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .add-comment-main-div {
        width: 100%;
        height: auto;
        border: 1px solid #ddd;
        padding: 2rem 0;
        margin: 4rem 0;
    }

    .add-comment-main-div-heading {
        width: 90%;
        margin: auto;
        padding: 1rem 0;
        border-bottom: 1.5px solid #ddd;
    }

    .add-comment-main-div-heading h3 {
        width: 100%;
        margin: auto;
        font-family: "Playfair Display", serif !important;
        font-weight: 400;
        color: #5f5f5f;
    }

    .add-comment-main-div-body {
        width: 90%;
        margin: 2rem auto;
    }

    .add-comment-main-div-body textarea {
        width: 100%;
        height: 100px;
        border: 1.5px solid #ddd;
        outline: 0;
        font-family: "Playfair Display", serif !important;
        padding: 1rem;
    }

    .add-comment-main-div-body-sub-section {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin: 1rem 0;
    }

    .add-comment-main-div-body-sub-section P {
        font-size: 15px;
        font-weight: 400;
        font-family: "Playfair Display", serif !important;
    }

    .add-comment-main-div-body-sub-section-btns {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 1rem;
    }

    .add-comment-main-div-body-sub-section-btns button {
        padding: 5px 7px;
        border: 0;
        outline: 0;
        cursor: pointer;
        font-size: 15px;
        font-weight: 400;
        font-family: "Playfair Display", serif !important;
        background: transparent;
    }

    .add-comment-main-div-body-sub-section-btns button:active {
        opacity: 0.7;
    }

    .add-comment-main-div-body-sub-section-btns .publish {
        background: #ffde59;
        color: #5f5f5f;
    }

    @media (max-width: 768px) {
        .add-comment-main-div {
            width: 100%;
            height: auto;
            border: 1px solid #ddd;
            padding: 0;
            margin: 4rem 0;
        }

        .add-comment-main-div-heading {
            width: 90%;
            margin: auto;
            padding: 1rem 0;
            border-bottom: 1.5px solid #ddd;
        }

        .add-comment-main-div-body {
            width: 90%;
            margin: 2rem auto;
        }

        .add-comment-main-div-body textarea {
            width: 100%;
            height: 100px;
            border: 1.5px solid #ddd;
            outline: 0;
            font-family: "Playfair Display", serif !important;
        }
    }
</style>
