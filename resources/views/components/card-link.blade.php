<div class="card">
    <a href="{{ route($route) }}">
    </a>
    <h3 class="card-arrow-right-heading">View All</h3>
    <div class="card-arrow-right-wrapper">
        <img src="{{ url('next (1).png') }}" class="card-arrow-right" alt="">
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
        min-height: 350px !important;
        height: 350px;
        max-height: 350px;
        border: 1px solid #dddddd93;
        display: flex;
        flex-direction: column;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        cursor: pointer;
    }

    .card-arrow-right-heading {
        font-size: 17px;
        font-weight: 500;
        font-family: "Playfair Display", serif !important;
        margin-bottom: 1rem;
        color: #5f5f5f;
    }

    .card-arrow-right-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #ffde59;
        aspect-ratio: 1 / 1;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    /* Circle border */
    .card-arrow-right-wrapper::before {
        content: "";
        position: absolute;
        right: -25%;
        top: 0;
        width: 47px;
        height: 47px;
        border-radius: 50%;
        border: 1px solid #ffde59;
        aspect-ratio: 1 / 1;
        z-index: -2;
    }

    .card-arrow-right-wrapper .card-arrow-right {
        width: 18px;
    }

    .card a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 60%;
    }
</style>
