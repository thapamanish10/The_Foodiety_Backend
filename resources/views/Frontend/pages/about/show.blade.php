@extends('Frontend.layouts.main')

@section('content')
    <x-main-heading title="Our Story"/>
    <div class="about-artical-main-container">
        @foreach ($abouts as $about)
            <artical class="about-artical">
                <section class="about-articel-section about-article-section-img-div">
                    <img class="blogLogo" src="{{ asset('storage/' . $about->logo) }}" alt="Blog Image" width="40">
                </section>
                <section class="about-articel-section">
                    <h1>Welcome to {{ $about->name }}</h1>
                    <div>{!! $about->desc !!}</div>
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
            gap: 3rem;
            max-height: 450px;
            padding: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .about-artical .about-articel-section,
        .about-article-section-img-div {
            height: 100%;
            overflow: hidden;
        }

        .about-article-section-img-div img {
            width: 100%;
            height: 450px;
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

        strong {
            font-weight: bold;
            font-family: "Playfair Display", serif;
        }
    </style>
@endsection
