@foreach ($abouts as $about)
    <artical class="about-artical">
        <section class="about-article-section-img-div">
            <img class="blogLogo" src="{{ asset('storage/' . $about->logo) }}" alt="Blog Image" >
        </section>
        <section class="about-articel-section">
            <section><div class="our-story">OUR STORY</div>
            <div>{!! Str::limit($about->desc, 800) !!}</div></section>
            <section><a href="{{ route('home.business.show', ['busines' => $about->id."-%-".$about->name]) }}">More About Us</a></section>
        </section>
    </artical>
@endforeach
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
    .our-story {
        font-size: 36px;
        font-weight: bold;
        font-family: "Playfair Display", serif;
    }
    p{
        padding: 0;
        margin: 0;
        font-size: 16px;
        margin-bottom: 20px;
        text-align: justify;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        color: #5f5f5f;
        text-align: justify;
        display: -webkit-box;
        overflow: hidden;
        position: relative;
        padding: .5rem 0;
        margin: 0;
    }

    .about-artical {
        max-width: 65%;
        margin:  auto;
        display: flex;
        gap: 3rem;
        height: 370px;
        min-height: 370px;
        max-height: 370px;
        padding: 5px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
        .about-article-section-img-div {
        flex-basis: 50%;
        height: 100%;
        overflow: hidden;
    }

    .about-article-section-img-div img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .about-artical .about-articel-section .about-article-section-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    .about-articel-section{
        flex-basis: 50%;
        height: 100%;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
    }



    .about-articel-section a {
        color: #ffd415;
        font-size: 16px;
        font-weight: 500;
        text-transform: uppercase;
        margin-top: 1rem;
    }

    strong {
        font-weight: bold;
        font-family: "Playfair Display", serif;
    }


    @media (max-width: 768px) {
        .about-artical {
            max-width: 100%;
            margin: 1rem auto;
            display: flex;
            gap: 1rem;
            flex-direction: column;
            max-height: max-content;
            padding: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .about-articel-section h1,
        .about-articel-section a,
        .about-articel-section p {
            padding: 0 .5rem;
        }
        .about-articel-section h1{
            display: none !important;
        }
        .about-articel-section p {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: justify;
            font-family: "Playfair Display", serif;
            font-weight: 400;
            color: #5f5f5f;
            text-align: justify;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
            max-height: calc(1.5em * 4);
            position: relative;
        }
    }
</style>
