@php
    $abouts = App\Models\About::all();
@endphp
<nav class="navbar" id="navbar">
    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            ☰ Menu
        </button>
        <div class="logo">THE FOODIETY</div>
        @auth
            <div class="logoutButton mobile-logout">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('power-off (1).png') }}" alt="Logout">
                </a>
            </div>
        @else
            <a href="{{ route('continue.with') }}" class="mobile-signup">SIGN UP</a>
        @endauth
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div class="mobile-menu" id="mobileNavbar">
        <button class="mobile-close-btn" id="mobileCloseBtn">×</button>
        <div class="mobile-menu-content">
            <div class="mobile-nav-links">
                <a class="{{ Request::is('/') ? 'activeNavLink' : '' }}" href="{{ url('/') }}">Home</a>
                <a class="{{ Request::is('home/services') ? 'activeNavLink' : '' }}" href="{{ route('home.services.index') }}">Services</a>
                <a class="{{ Request::is('home/galleries') ? 'activeNavLink' : '' }}" href="{{ route('home.galleries.index') }}">Gallery</a>
                <a class="{{ Request::is('home/blogs') ? 'activeNavLink' : '' }}" href="{{ route('home.blogs.index') }}">Blogs</a>
                <a class="{{ Request::is('home/restaurants') ? 'activeNavLink' : '' }}" href="{{ route('home.restaurants.index') }}">Restaurant</a>
                <a class="{{ Request::is('home/recipes') ? 'activeNavLink' : '' }}" href="{{ route('home.recipes.index') }}">Recipes</a>
                <a class="{{ Request::is('home/ais') ? 'activeNavLink' : '' }}" href="{{ route('home.ais.index') }}">Foodiety Ai</a>
                @foreach ($abouts as $about)
                <a class="{{ Request::is('home/business') ? 'activeNavLink' : '' }}" href="{{ route('home.business.show', $about->id."-".$about->name) }}">About</a>
                @endforeach
                <a class="{{ Request::is('home/contact') ? 'activeNavLink' : '' }}" href="{{ route('home.contact.index') }}">Contact</a>
                <a href="#" class="follow-trigger" id="mobileFollowTrigger">Follow</a>
            </div>
            
            <!-- Mobile Follow Section -->
            @foreach ($abouts as $about)
            <div class="mobile-topbar" id="mobileTopbar">
                <div class="mobile-topbar-section">
                    <h3>Follow us:</h3>
                    <div class="social-icons">
                        @if ($about->facebook)
                            <a href="{{ $about->facebook }}"><img src="{{ url('fb.png') }}" alt="Facebook"></a>
                        @endif
                        @if ($about->instagram)
                            <a href="{{ $about->instagram }}"><img src="{{ url('in.png') }}" alt="Instagram"></a>
                        @endif
                        @if ($about->youtube)
                            <a href="{{ $about->youtube }}"><img src="{{ url('yt.png') }}" alt="YouTube"></a>
                        @endif
                        @if ($about->tiktok)
                            <a href="{{ $about->tiktok }}"><img src="{{ url('tk.png') }}" alt="TikTok"></a>
                        @endif
                        @if ($about->thread)
                            <a href="{{ $about->threads }}"><img src="{{ url('td.png') }}" alt="Threads"></a>
                        @endif
                    </div>
                </div>
                <div class="mobile-topbar-section">
                    @if ($about->number)
                        <a href="{{ $about->number }}" class="contact-link">
                            <img src="{{ url('wa.png') }}" alt="WhatsApp">
                            <span>{{ $about->number }}</span>
                        </a>
                    @endif
                    @if ($about->opt_number)
                        <a href="{{ $about->opt_number }}" class="contact-link">
                            <span>{{ $about->opt_number }}</span>
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Desktop Navigation -->
    <div class="desktop-nav">
        <div class="nav-left">
            <a class="{{ Request::is('/') ? 'activeNavLink' : '' }}" href="{{ url('/') }}">Home</a>
            <a class="{{ Request::is('home/services') ? 'activeNavLink' : '' }}" href="{{ route('home.services.index') }}">Services</a>
            <a class="{{ Request::is('home/galleries') ? 'activeNavLink' : '' }}" href="{{ route('home.galleries.index') }}">Gallery</a>
            <a class="{{ Request::is('home/blogs') ? 'activeNavLink' : '' }}" href="{{ route('home.blogs.index') }}">Blogs</a>
            <a class="{{ Request::is('home/restaurants') ? 'activeNavLink' : '' }}" href="{{ route('home.restaurants.index') }}">Restaurant</a>
            <a class="{{ Request::is('home/recipes') ? 'activeNavLink' : '' }}" href="{{ route('home.recipes.index') }}">Recipes</a>
           <a class="{{ Request::is('home/ais') ? 'activeNavLink' : '' }}" href="{{ route('home.ais.index') }}">Foodiety Ai</a>
        </div>
        <div class="logo">THE FOODIETY</div>
        <div class="nav-left nav-right">
            @foreach ($abouts as $about)
            <a class="{{ Request::is('home/business') ? 'activeNavLink' : '' }}" href="{{ route('home.business.show', $about->id."-".$about->name) }}">About</a>
            @endforeach
            <a class="{{ Request::is('home/contact') ? 'activeNavLink' : '' }}" href="{{ route('home.contact.index') }}">Contact</a>
            <a href="#" class="follow-trigger" id="followTrigger">Follow</a>
            @auth
                <div class="logoutButton">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset('power-off (1).png') }}" alt="BlogIcon">
                        <span>Logout</span>
                    </a>
                </div>
            @else
                <a href="{{ route('continue.with') }}">SIGN UP</a>
            @endauth
        </div>
    </div>

    <!-- Desktop Follow Section -->
    @foreach ($abouts as $about)
        <div class="topbar-main-container" id="topbar">
            <div class="topbar-main-container-section">
                <h3>Follow us:</h3>
                <div class="topbar-main-container-section-card">
                    @if ($about->facebook)
                        <a href="{{ $about->facebook }}"><img src="{{ url('fb.png') }}" alt="Facebook"></a>
                    @endif
                    @if ($about->instagram)
                        <a href="{{ $about->instagram }}"><img src="{{ url('in.png') }}" alt="Instagram"></a>
                    @endif
                    @if ($about->youtube)
                        <a href="{{ $about->youtube }}"><img src="{{ url('yt.png') }}" alt="YouTube"></a>
                    @endif
                    @if ($about->tiktok)
                        <a href="{{ $about->tiktok }}"><img src="{{ url('tk.png') }}" alt="TikTok"></a>
                    @endif
                    @if ($about->thread)
                        <a href="{{ $about->threads }}"><img src="{{ url('td.png') }}" alt="Threads"></a>
                    @endif
                </div>
            </div>
            <div class="topbar-main-container-section">
                <div class="topbar-main-container-section-card">
                    @if ($about->number)
                        <a href="{{ $about->number }}">
                            <img src="{{ url('wa.png') }}" alt="WhatsApp">
                            <h3>{{ $about->number }}</h3>
                        </a>
                    @endif
                    @if ($about->opt_number)
                        <a href="{{ $about->opt_number }}">
                           |  <h3>{{ $about->opt_number }}</h3>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileCloseBtn = document.getElementById('mobileCloseBtn');
        const mobileNavbar = document.getElementById('mobileNavbar');
        const followTrigger = document.getElementById('followTrigger');
        const mobileFollowTrigger = document.getElementById('mobileFollowTrigger');
        const topbar = document.getElementById('topbar');
        const mobileTopbar = document.getElementById('mobileTopbar');
        const navbar = document.getElementById('navbar');
        
        // Check if we're on the home page
        const isHomePage = window.location.pathname === '/';
        
        // Set initial navbar style for home page
        if (isHomePage) {
            navbar.style.background = 'transparent';
            navbar.style.boxShadow = 'none';
        }
        
        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileNavbar.classList.add('active');
        });

        // Close mobile menu
        mobileCloseBtn.addEventListener('click', function() {
            mobileNavbar.classList.remove('active');
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileNavbar.contains(e.target) && e.target !== mobileMenuToggle) {
                mobileNavbar.classList.remove('active');
            }
        });

        // Toggle follow section (desktop)
        if (followTrigger) {
            followTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                topbar.style.display = topbar.style.display === 'block' ? 'none' : 'block';
            });
        }

        // Toggle follow section (mobile)
        if (mobileFollowTrigger) {
            mobileFollowTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                mobileTopbar.style.display = mobileTopbar.style.display === 'block' ? 'none' : 'block';
            });
        }

        // Close follow section when clicking outside (desktop)
        document.addEventListener('click', function(e) {
            if (!topbar.contains(e.target) && e.target !== followTrigger) {
                topbar.style.display = 'none';
            }
        });

        // Window scroll handler for navbar effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.style.background = '#fff';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                navbar.style.position = 'fixed';
                navbar.style.top = '0';
            } else {
                if (isHomePage) {
                    navbar.style.background = 'transparent';
                    navbar.style.boxShadow = 'none';
                } else {
                    navbar.style.background = '#fff';
                    navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                }
            }
        });

        // Window resize handler
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                mobileNavbar.classList.remove('active');
            }
        });
    });
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    .navbar {
    position: fixed; 
    width: 100%;
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    font-family: "Raleway", sans-serif;
    transition: all 0.3s ease;
    top: 0; 
    }
    .logo {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 1rem 0;
    }



    /* Mobile Styles */
    .mobile-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
    }

    .mobile-menu-toggle {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .mobile-logout img {
        width: 20px;
        height: 20px;
    }

    .mobile-signup {
        padding: 0.5rem;
        background: #ffde59;
        color: white;
        border-radius: 4px;
        text-decoration: none;
    }

    .mobile-menu {
        position: fixed;
        top: 0;
        left: -100%;
        width: 80%;
        max-width: 300px;
        height: 100vh;
        background: white;
        z-index: 1001;
        transition: left 0.3s ease;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        overflow-y: auto;
    }

    .mobile-menu.active {
        left: 0;
    }

    .mobile-close-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        background: none;
        border: none;
        cursor: pointer;
    }

    .mobile-menu-content {
        padding: 2rem 1rem;
    }

    .mobile-nav-links {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .mobile-nav-links a {
        padding: 0.5rem 0;
        text-decoration: none;
        color: #5f5f5f;
        border-bottom: 2px solid #eee;
        font-size: 15px;
        font-weight: 600 !important;
        text-transform: uppercase;
    }

    .mobile-topbar {
        margin-top: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .mobile-topbar-section {
        margin-bottom: 1rem;
    }

    .social-icons {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .social-icons img {
        width: 24px;
        height: 24px;
    }

    .contact-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        color: #5f5f5f;
    }

    /* Desktop Styles */
    .desktop-nav {
        display: none;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
    }

        .logo {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 1rem 0;
        flex-wrap: nowrap;
        white-space: nowrap;
    }
    .nav-left, .nav-right {
        width: 50%;
        display: flex;
        gap: 1.5rem;
    }
        .nav-right {
            justify-content: flex-end;
        }

    .nav-left a, .nav-right a {
        text-decoration: none;
        text-transform: uppercase;
        color: #5f5f5f;
        padding: 1rem 0;
        font-size: 15px;
        font-weight: 600 !important;
        transition: 0.3s ease-in-out;
        border: 2px solid transparent;
    }
    .nav-left a:hover, .nav-right a:hover {
        border-bottom: 2px solid #ffde59;
    }
    .activeNavLink {
        color: #ffde59 !important;
        border-bottom: 2px solid #ffde59;
    }
    .logoutButton a {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .logoutButton img {
        width: 16px;
        height: 16px;
    }
    .topbar-main-container{
        width: 100%;
    }
    .topbar-main-container-section{
        display: flex !important;
        align-items: center;
        gap: 1rem;
    }
    .topbar-main-container-section-card{
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .topbar-main-container-section-card a{
        display: flex;
        align-items: center;
        gap: .5rem;

    }
    .topbar-main-container-section-card a img{
        width: 30px;
        height: 30px;
        object-fit: cover;
    }

    /* Follow Section */
    .topbar-main-container {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #f8f9fa;
        padding: 1rem 2rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Responsive Breakpoint */
    @media (min-width: 992px) {
        .mobile-nav {
            display: none;
        }

        .desktop-nav {
            display: flex;
        }

        .logo {
            padding: 0;
        }
    }

    /* Overlay for mobile menu */
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        display: none;
    }

    .mobile-menu-overlay.active {
        display: block;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileCloseBtn = document.getElementById('mobileCloseBtn');
        const mobileNavbar = document.getElementById('mobileNavbar');
        const followTrigger = document.getElementById('followTrigger');
        const mobileFollowTrigger = document.getElementById('mobileFollowTrigger');
        const topbar = document.getElementById('topbar');
        const mobileTopbar = document.getElementById('mobileTopbar');
        
        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileNavbar.classList.add('active');
        });

        // Close mobile menu
        mobileCloseBtn.addEventListener('click', function() {
            mobileNavbar.classList.remove('active');
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileNavbar.contains(e.target) && e.target !== mobileMenuToggle) {
                mobileNavbar.classList.remove('active');
            }
        });

        // Toggle follow section (desktop)
        if (followTrigger) {
            followTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                topbar.style.display = topbar.style.display === 'block' ? 'none' : 'block';
            });
        }

        // Toggle follow section (mobile)
        if (mobileFollowTrigger) {
            mobileFollowTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                mobileTopbar.style.display = mobileTopbar.style.display === 'block' ? 'none' : 'block';
            });
        }

        // Close follow section when clicking outside (desktop)
        document.addEventListener('click', function(e) {
            if (!topbar.contains(e.target) && e.target !== followTrigger) {
                topbar.style.display = 'none';
            }
        });

        // Window resize handler
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                mobileNavbar.classList.remove('active');
            }
        });
    });
</script>