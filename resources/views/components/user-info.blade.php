@props([
    'facebook' => '',
    'instagram' => 'https://www.instagram.com/',
    'data' => '',
])
<div class="main-blog-detail-div-user-info">
    <div class="main-blog-detail-div-user-info-card">
        <img src="https://images.pexels.com/photos/32645258/pexels-photo-32645258.jpeg" alt="User"
            class="main-blog-detail-div-user-image">
        <div class="main-blog-detail-div-user-info-user-details">
            <div class="user-info-name">The Foodiety</div>
            <div class="user-info-publish-date">{{ $data }}</div>
        </div>
    </div>
    <div class="share-div share-button">
        <img src="{{ asset('share.png') }}" alt="Share">
        <div class="share-div-model">
            <div class="share-div-model-link">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                    target="_blank">
                    <img src="{{ url('fb.png') }}" alt=""> <span>Facebook</span>
                </a>
            </div>
            <div class="share-div-model-link">
                <a href="{{ $instagram }}" target="_blank">
                    <img src="{{ url('in.png') }}" alt=""><span>Instagram</span>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .main-blog-detail-div-user-info {
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 5;
    }

    .main-blog-detail-div-user-info-card {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .main-blog-detail-div-user-image {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
    }

    .main-blog-detail-div-user-info-user-details {
        display: flex;
        gap: .3rem;
        flex-direction: column;
    }

    .user-info-name {
        font-size: 16px;
        font-weight: 600;
        white-space: nowrap;
        color: #5f5f5f;
        font-family: "Playfair Display", serif !important;
        text-transform: uppercase;
        padding: 0;
    }

    .user-info-publish-date {
        font-size: 12px;
        font-weight: 500;
        color: #5f5f5f;
    }

    .share-div {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        z-index: 100000;
    }

    .share-div img {
        width: 65%;
        height: 65%;
        object-fit: contain;
    }

    .share-div-model {
        position: absolute;
        top: 105%;
        right: 0;
        width: 150px;
        height: max-content;
        background: #ffffff;
        border: 1px solid #dddddd4d;
        opacity: 0;
        transition: opacity 0.2s ease;
        display: none;
        flex-direction: column;
        z-index: 100;
    }

    .share-div-model.show {
        opacity: 1;
        display: flex;
    }

    .share-div-model-link a {
        width: 100%;
        height: 45px !important;
        position: relative !important;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        font-size: 14px;
        font-weight: 500;
        font-family: "Playfair Display", serif !important;
        color: #5f5f5f;
        text-decoration: none;
        transition: 0.3s ease;
    }

    .share-div-model-link a:hover {
        background: #dddddd36;
    }

    .share-div-model-link a img {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }

    .share-div-model .share-div-model-link:hover {
        background: #dddddd36;
    }

    .main-blog-detail-div-heading {
        width: 100%;
        font-size: 30px;
        margin: auto;
        padding: 1rem 0;
        font-family: "Playfair Display", serif !important;
        font-weight: 400;
        color: #5f5f5f;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ② Cache all buttons once
        const buttons = document.querySelectorAll('.share-button');

        buttons.forEach(btn => {
            const menu = btn.querySelector('.share-div-model');

            /* ③ Open / close on the button itself */
            btn.addEventListener('click', e => {
                e.stopPropagation(); // <-- keep click inside
                toggle(menu);
            });

            /* ④ Clicks *inside* the pop‑over stay inside too */
            menu.addEventListener('click', e => e.stopPropagation());

            /* ⑤ Same for each link inside the menu */
            menu.querySelectorAll('a').forEach(a =>
                a.addEventListener('click', e => e.stopPropagation())
            );
        });

        /* ⑥ Any click that *does* reach <document> is outside ⇒ close everything */
        document.addEventListener('click', closeAll);

        /* ---------- helpers ---------- */
        function closeAll() {
            document.querySelectorAll('.share-div-model.show')
                .forEach(m => m.classList.remove('show'));
        }

        function toggle(target) {
            // close others first
            document.querySelectorAll('.share-div-model.show')
                .forEach(m => {
                    if (m !== target) m.classList.remove('show');
                });

            target.classList.toggle('show');
        }
    });
</script>
