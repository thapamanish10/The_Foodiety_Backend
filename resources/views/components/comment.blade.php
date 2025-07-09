@props(['comment'])
<section class="comment-main-div">
    <div class="comment-main-div-user-info">
        <img src="{{ url('user (1).png') }}" alt="{{ $comment->user->name }}" class="comment-main-div-user-image">
        <div class="comment-main-div-user-info-user-details">
            <h3>{{ $comment->user->name ?? 'Unknown User' }}</h3>
            <p>{{ $comment->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <p class="comment-message">{{ $comment->content }}</p>
    {{-- @auth
        <button class="reply-btn" data-comment-id="{{ $comment->id }}">Reply</button>
    @endauth --}}
</section>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .comment-main-div {
        width: 90%;
        margin: auto;
        height: fit-content;
        padding-top: 1rem;
        margin: 1rem 0 2rem 0;
    }

    .comment-main-div-user-info {
        width: 90%;
        margin: auto;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 5;
    }

    .comment-main-div-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        border: 1.5px solid #ffde594b;
        padding: .1rem;
    }

    .comment-main-div-user-info-user-details h3 {
        font-size: 16px;
        font-weight: 600;
        color: #5f5f5f;
        text-transform: capitalize;
        margin-bottom: 0;
    }

    .comment-main-div-user-info-user-details p {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
        margin-top: .3rem;
        text-align: justify;
    }

    .comment-main-div-share {
        position: absolute;
        top: 50%;
        right: 0%;
        transform: translate(0%, -50%);
        width: 20px;
        height: 20px;
    }

    .comment-message {
        display: block;
        width: 90%;
        margin-left: 6.5rem;
        padding-bottom: 1rem;
        font-size: 14px;
        border-bottom: 1.5px solid #ddd;
        font-family: "Playfair Display", serif !important;
    }

    @media (max-width: 768px) {
        .comment-message {
            width: 100%;
            margin-left: 22px;
        }
    }
</style>
