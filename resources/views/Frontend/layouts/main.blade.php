<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('Frontend.layouts.head')
    @stack('styles')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Foodiety - {{ config('app.name', 'The Foodiety') }}</title>
    <link rel="icon" href="{{ asset('the-foodiety-logo1.png') }}" type="image/png">
</head>
<style>
body, html {
    margin: 0;
    padding: 0;
    width: 100%;
    overflow-x: hidden; 
    /* background: #f8f8ff93; */
}
</style>

<body class="{{ $bodyClass ?? '' }}">
    @include('Frontend.layouts.navbar')
        <main>
            @yield('content')
            <x-loading-screen />
        </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Restore scroll position
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                requestAnimationFrame(() => {
                    window.scrollTo(0, parseInt(scrollPosition));
                    sessionStorage.removeItem('scrollPosition');
                });
            }

            // Debounce function to limit how often we save position
            let saveScrollTimeout;
            const saveScrollPosition = () => {
                clearTimeout(saveScrollTimeout);
                saveScrollTimeout = setTimeout(() => {
                    sessionStorage.setItem('scrollPosition', window.scrollY || window.pageYOffset);
                }, 100);
            };

            window.addEventListener('scroll', saveScrollPosition);

            window.addEventListener('beforeunload', saveScrollPosition);
        });
    </script>
    @include('Frontend.layouts.footer')
    @stack('scripts')
    @yield('meta')
</body>
</html>