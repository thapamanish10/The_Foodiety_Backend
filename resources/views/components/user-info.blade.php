
@props(['shareLinks' => []])
<div class="main-blog-detail-div-user-info">
    <div class="main-blog-detail-div-user-info-card">
        <img src="https://images.pexels.com/photos/32645258/pexels-photo-32645258.jpeg" alt="User"
            class="main-blog-detail-div-user-image">
        <div class="main-blog-detail-div-user-info-user-details">
            <div class="user-info-name">The Foodiety</div>
            <div class="user-info-publish-date">Jan 2025</div>
        </div>
    </div>
    <div class="share-div share-button"  onclick="copyToClipboard('{{ $shareLinks['copy_link'] ?? '#' }}')">
        <img src="{{ asset('share.png') }}" alt="Share">
    </div>
</div>
<script>
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Link copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    };
</script>
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
</style>
