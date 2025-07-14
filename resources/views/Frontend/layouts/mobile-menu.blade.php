@php
    $abouts = App\Models\About::all();
@endphp
<nav class="mobile-navbar" id="mobileNavbar">
    <div class="mobile-nav-logo">THE FOODIETY</div>
    <div class="mobile-nav-left">
        <a class="{{ Request::is('/') ? 'activeNavLink' : '' }}" href="{{ url('/') }}">Home</a>
        <a class="{{ Request::is('home/services') ? 'activeNavLink' : '' }}"
            href="{{ route('home.services.index') }}">Services</a>
        <a class="{{ Request::is('home/galleries') ? 'activeNavLink' : '' }}"
            href="{{ route('home.galleries.index') }}">Gallery</a>
        <a class="{{ Request::is('home/blogs') ? 'activeNavLink' : '' }}"
            href="{{ route('home.blogs.index') }}">Blogs</a>
        <a class="{{ Request::is('home/restaurants') ? 'activeNavLink' : '' }}"
            href="{{ route('home.restaurants.index') }}">Restaurant</a>
        <a class="{{ Request::is('home/recipes') ? 'activeNavLink' : '' }}"
            href="{{ route('home.recipes.index') }}">Recipes</a>
        <a href="{{ url('/') }}">Foodiety Ai</a>
    </div>
    <div class="mobile-nav-left mobile-nav-right">
        @foreach ($abouts as $about)
            <a class="{{ Request::is('home/business') ? 'activeNavLink' : '' }}"
                href="{{ route('home.business.show', $about->id . '-' . $about->name) }}">About</a>
        @endforeach
        <a class="{{ Request::is('home/contact') ? 'activeNavLink' : '' }}"
            href="{{ route('home.contact.index') }}">Contact</a>
        <a href="#" class="follow-trigger" id="followTrigger">Follow</a>
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{-- <img src="{{ asset('power-off (1).png') }}" alt="BlogIcon"> --}}
                <span>Logout</span>
            </a>
        @else
            <a href="{{ route('continue.with') }}">SIGN UP </a>
        @endauth
    </div>
    @foreach ($abouts as $about)
        <div class="topbar-main-container" id="topbar">
            <div class="topbar-main-container-section">
                <h3>Follow us:</h3>
                <div class="topbar-main-container-section-card">
                    @if ($about->facebook)
                        <a href="{{ $about->facebook }}">
                            <img src="{{ url('fb.png') }}" alt="">
                        </a>
                    @endif
                    @if ($about->instagram)
                        <a href="{{ $about->instagram }}">
                            <img src="{{ url('in.png') }}" alt="">
                        </a>
                    @endif
                    @if ($about->youtube)
                        <a href="{{ $about->youtube }}">
                            <img src="{{ url('yt.png') }}" alt="">
                        </a>
                    @endif
                    @if ($about->tiktok)
                        <a href="{{ $about->tiktok }}">
                            <img src="{{ url('tk.png') }}" alt="">
                        </a>
                    @endif
                    @if ($about->thread)
                        <a href="{{ $about->threads }}">
                            <img src="{{ url('td.png') }}" alt="">
                        </a>
                    @endif
                </div>
            </div>
            <div class="topbar-main-container-section">
                <div class="topbar-main-container-section-card">
                    @if ($about->number)
                        <a href="{{ $about->number }}">
                            <img src="{{ url('wa.png') }}" alt="">
                            <h3>{{ $about->number }}</h3>
                        </a>
                    @endif
                    @if ($about->opt_number)
                        <a href="{{ $about->opt_number }}">
                            | <h3>{{ $about->opt_number }}</h3>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</nav>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');

    .mobile-navbar {
        width: 70%;
        background: #ffffff;
        height: 100vh;
        overflow-y: auto;
        z-index: 1000;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 20px 0;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .mobile-navbar.active {
        transform: translateX(0);
    }

    .mobile-nav-logo {
        width: 100%;
        padding: 1rem 2.5rem;
        font-size: 15px;
        font-weight: 700;
        text-transform: uppercase;
        color: #5f5f5f;
        text-decoration: none;
        text-align: start;
        transition: background-color 0.2s ease;
        font-family: "Raleway", sans-serif !important;
    }

    .mobile-nav-left {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: .5rem;
    }

    .mobile-nav-left a {
        width: 100%;
        padding: 1rem 2.5rem;
        font-size: 15px;
        font-weight: 500;
        text-transform: uppercase;
        color: #5f5f5f;
        text-decoration: none;
        text-align: start;
        transition: background-color 0.2s ease;
        font-family: "Raleway", sans-serif !important;
        position: relative;
    }

    .mobile-nav-left a:hover {
        background: #facf4277;
        /* Hover effect */
    }

    .mobile-nav-left a:after {
        content: '';
        position: absolute;
        width: 0;
        height: 1.5px;
        bottom: -5px;
        left: 0;
        background-color: currentColor;
        transition: width 0.3s ease;
        color: #ffe600;
    }

    /* Change this */
    .mobile-nav-left a.activeNavLink:after {
        width: 100%;
    }

    /* And add this for nav-right active links */
    .mobile-nav-right a.activeNavLink:after {
        width: 100%;
    }

    /* Close button style */
    .mobile-close-btn {
        align-self: flex-end;
        padding: 10px 20px;
        font-size: 24px;
        background: none;
        border: none;
        cursor: pointer;
        color: #000;
    }
</style>
