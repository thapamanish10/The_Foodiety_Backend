<section class="see-all-div">
    <h3 class="see-all-div-heading">Recent {{ $type }}</h3>
    <p class="see-all-div-desc"><a href="{{ route($route) }}">See All</a></p>
</section>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .see-all-div {
        width: 100%;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .see-all-div-heading {
        padding: 0.5rem 0;
        font-family: "Playfair Display", serif !important;
        font-weight: 400;
        color: #5f5f5f;
    }

    .see-all-div-desc a {
        padding: 0.5rem 0;
        font-size: 14px;
        font-weight: 400;
        color: #5f5f5f;
        font-family: "Playfair Display", serif !important;
        text-decoration: none;
    }
</style>
