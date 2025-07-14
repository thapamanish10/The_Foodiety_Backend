@extends('Frontend.layouts.main')

@section('content')
    <br>
    <br>
    <br>
    <div class="about-artical-main-container">
        @foreach ($abouts as $about)
            <artical class="about-artical">
                <section class="about-articel-section about-article-section-img-div">
                    <img class="blogLogo" src="{{ asset('storage/' . $about->logo) }}" alt="Blog Image" width="40">
                </section>
                <section class="about-articel-section">
                    <h1>Welcome to {{ $about->name }}</h1>
                    <p class="about-articel-section-desc">{!! $about->desc !!}</p>
                </section>
            </artical>
        @endforeach
        <x-heading title="Our Services" />
        @include('Frontend.services.home-service')
        <br>
        <br>
        <br>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .about-artical-main-container {
            max-width: 65%;
            margin: auto;
        }

        .about-artical {
            width: 100%;
            margin: 2rem auto;
            display: flex;
            gap: 3rem;
            max-height: 450px;
            padding: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .about-artical .about-articel-section,
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

        .about-articel-section a {
            color: #ffd415;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            font-family: "Playfair Display", serif;
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
            position: relative;
        }

        strong {
            font-weight: bold;
            font-family: "Playfair Display", serif;
        }
    </style>
@endsection
