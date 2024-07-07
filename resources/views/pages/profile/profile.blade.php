@extends('pages.home')

@section('content')
    <main class="dashboardContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(2) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="userInfo">
            <div class="userImage">
                <img src="https://images.pexels.com/photos/20640155/pexels-photo-20640155/free-photo-of-portrait-of-woman-in-shadow.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    alt="">
                <div class="userName">
                    <h3>Hello World</h3>
                    <span>CEO of Foodiety</span>
                </div>
                {{-- <div class="editBtn">
                    <ion-icon name="create-outline"></ion-icon>
                </div> --}}
            </div>
        </div>
    </main>
@endsection
