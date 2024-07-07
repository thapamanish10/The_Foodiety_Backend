@extends('pages.home')

@section('content')
    <main class="productsContainer">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <img src="{{ asset('./assets/das.png') }}" class="dasimage" alt="">
    </main>
@endsection
