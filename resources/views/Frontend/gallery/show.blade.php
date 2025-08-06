@extends('Frontend.layouts.main')

@section('content')
    <div class="services-index-div">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="card3-content-user-info">
            <div class="card3-content-user-info-sub">
                <img src="{{ url('foodiety.png') }}" alt="" class="card3-content-user-image">
                <div class="card3-content-user-info-user-details">
                    <h3>The Foodiety</h3>
                    <span>{{ $gallery->created_at->format('d M') }}</span>
                </div>
            </div>
            <div class="card3-content-user-info-sub">
                <a href="{{ route('galleries.download', $gallery) }}" class="btn btn-success download-btn">Free Download <img src="{{ url('arrow.png') }}" alt=""></a>
                {{-- <img src="{{ asset('share.png') }}" alt="" class="card3-content-share"> --}}
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" alt="{{ $gallery->name }}" loading="lazy">
        </div>
        <div class="card-body">
            <h1 class="card-title">{{ $gallery->name }}</h1>
            @if ($gallery->description)
                <p class="card-text">{{ $gallery->description }}</p>
            @endif
        </div>
    </div>
@endsection
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    .services-index-div {
        width: 55%;
        margin: auto;
    }
    .card{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 1rem;
    }
    .card-body{
        width: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .card3-content-user-info {
       width: 100%;
       display: flex;
       align-items: center;
       justify-content: space-between;
       position: relative;
       z-index: 5;
       margin-bottom: 2rem;
   }
   .card3-content-user-info-sub{
    display: flex;
    align-items: center;
    gap: 1rem;
   }
   .card3-content-user-image {
       width: 45px;
       height: 45px;
       object-fit: cover;
       border-radius: 50%;
       border: 1.5px solid #ffde59;
       padding: .1rem;
   }

   .card3-content-user-info-user-details h3 {
       font-size: 16px;
       font-weight: 600;
       color: #5f5f5f;
       text-transform: uppercase;
       margin-bottom: 0;
       white-space: nowrap;
   }

   .card3-content-user-info-user-details span {
       font-size: 12px;
       font-weight: 500;
       color: #5f5f5f;
       margin-top: .1rem;
       margin-bottom: 0;
        font-family: "Raleway", sans-serif;
   }

   .card3-content-share {
       width: 20px;
       height: 20px;
       cursor: pointer;
   }
   .download-btn{
    width: fit-content;
    white-space: nowrap;
       padding: .5rem 1rem;
       border: 1px solid #ddd;
       cursor: pointer;
       text-decoration: none;
       color: #5f5f5f;
       font-weight: 500;
       font-size: 16px;
       background: #54ca84;
       color: #ffffff;
       border: 0;
       outline: 0;
       display: flex;
       align-items: center;
       justify-content: center;
       gap: 1rem;
       border-radius: .4rem;
        font-family: "Raleway", sans-serif;
   }
   .download-btn img{
    width: 20px;
    height: 20px;
   }
   .card img{
    height: 700px;
    margin: auto;
    object-fit: contain;
   }
   @media (max-width: 1200px) {
        .services-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 900px) {
        .services-index-div {
            width: 55%;
            margin: auto;
        }
    }

    @media (max-width: 600px) {
        .services-index-div {
            width: 100%;
            margin: auto;
        }
    }
</style>