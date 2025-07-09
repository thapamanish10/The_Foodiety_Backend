<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('Frontend.layouts.head')
</head>

<body class="{{ $bodyClass ?? '' }}">
    @include('Frontend.layouts.navbar')

    <div id="app">
        <main class="py-4">
            {{-- @include('partials.alerts') --}}
            @yield('content')
            <x-loading-screen />

        </main>
    </div>
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

            // Save position on scroll
            window.addEventListener('scroll', saveScrollPosition);

            // Save final position before leaving
            window.addEventListener('beforeunload', saveScrollPosition);
        });
    </script>
    @include('Frontend.layouts.footer')
    {{-- @include('layouts.scripts') --}}
    @stack('scripts')
</body>

</html>
