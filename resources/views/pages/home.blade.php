<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Foodiety')</title>
    <link rel="icon" href="{{ asset('assets/foodiety.png') }}" type="image/png">
    <!-- Other head elements -->
    <link rel="stylesheet" href="{{ asset('./css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/single.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/location.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/details.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/business.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/alert.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
</head>

<body>
    @include('layouts.topbar')
    @include('layouts.alert')
    @yield('content')
    @include('layouts.footer')
    @yield('ckScript')
    @yield('jsScript')
    @yield('alertScript')
    @yield('displayImageScript')
    @yield('carouselScript')
</body>

</html>
