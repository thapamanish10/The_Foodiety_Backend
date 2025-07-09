<section class="main-heading-div">
    <div class="main-heading-div-img">
        <img src="{{ url('foodiety.png') }}" alt="" class="main-heading-div-img-image">
    </div>
    <div class="main-heading-div-itext">
        <h1> {{ $title }}</h1>
    </div>
</section>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap');

    .main-heading-div {
        width: 100%;
        margin: 4rem auto;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        flex-direction: column;
        border-top: 1.5px solid #ddd;
        border-bottom: 1.5px solid #ddd;
    }

    .main-heading-div-img-image {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
    }

    .main-heading-div h1 {
        font-size: 25px;
        font-weight: 600;
        font-family: "Cinzel", serif;
        color: #5f5f5f;
        margin-bottom: 0;
        font-style: italic;
    }

    @media (max-width: 600px) {
        .main-heading-div {
            width: 100%;
            margin: 0 auto;
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            flex-direction: column;
            border-top: 1.5px solid #ddd;
            border-bottom: 1.5px solid #ddd;
        }
    }
</style>
