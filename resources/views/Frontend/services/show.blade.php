@extends('Frontend.layouts.main')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .services-main-div {
            width: 55%;
            height: 100vh;
            margin: auto;
        }

        .services-main-div-section {
            width: 100%;
            height: 350px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            overflow: hidden;
            background: #dddddd38;
        }

        .services-main-sub-section-left {
            width: 35%;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
            padding: 2rem;
        }

        .services-main-sub-section-left h1 {
            font-size: 35px;
            font-weight: 600;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .services-main-sub-section-left p {
            font-size: 15px;
            font-weight: 400;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .services-main-sub-section-left a {
            font-size: 15px;
            font-weight: 400;
            padding: .5rem 1.5rem;
            border: 1px solid #ffd414;
            color: #5f5f5f;
            width: max-content;
            text-decoration: none;
            margin-top: 1rem;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
            transition: 0.3s ease-in;
        }

        .services-main-sub-section-left a:hover {
            background: #ffd414;
        }

        .services-main-sub-section-right {
            width: 50%;
            height: 100%;

        }

        .services-main-sub-section-right img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .why-website-section {
            width: 100%;
        }

        .why-website-section h3 {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            padding: 1rem 0;
            font-weight: 600;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .what-we-offer h3 {
            width: 100%;
            display: flex;
            align-items: flex-start !important;
            justify-content: flex-start;
            font-size: 25px;
            padding: 2rem 0;
            font-weight: 600;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .why-website-section p {
            font-size: 15px;
            font-weight: 400;
            text-align: justify;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .what-we-offer {
            width: 20%;
        }

        .what-we-offer p {
            font-size: 15px;
            font-weight: 400;
            text-align: justify;
            font-family: "Playfair Display", serif !important;
            color: #5f5f5f;
        }

        .row {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
        }
    </style>
    <br>
    <br>
    <br>
    <br>
    <br>
    <section class="services-main-div">
        <div class="services-main-div-section">
            <div class="services-main-sub-section-left">
                <h1>{{ $service->title }}</h1>
                <p>{!! $service->info !!}</p>
                <a href="#contact" class="btn">Get Started</a>
            </div>
            <div class="services-main-sub-section-right">
                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="">
            </div>
        </div>
        <section class="why-website-section">
            <h3>Why {{ $service->name }}</h3>
            <p>{!! $service->why2 !!}
            </p>
        </section>
        <br>
        <div class="row">
            <section class="what-we-offer">
                <h3>What we offer</h3>
                <p>{!! $service->offer !!}
                </p>
            </section>
            <section class="what-we-offer">
                <h3>Why us?</h3>
                <p>{!! $service->why !!}
                </p>
            </section>
        </div>
    </section>
@endsection
