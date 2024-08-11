@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="totelItems">
            <h3>Total Items (0)</h3>
            <a href="{{ route('announcement.create') }}">
                <button class="addReview add">
                    <span>Create</span>
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
            </a>
        </div>
        {{-- <div class="productsContent">
        </div> --}}
        <p>No announcement available.</p>
    </main>
@endsection
