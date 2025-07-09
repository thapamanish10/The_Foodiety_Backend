<nav class="navbar" id="navbar">
    <div class="nav-left">
        <a href="{{ url('/') }}">Home</a>
        <a href="#">Services</a>
        <a href="{{ route('home.galleries.index') }}">Gallery</a>
        <a href="{{ route('home.blogs.index') }}">Blogs</a>
        <a href="{{ route('home.restaurants.index') }}">Restaurant</a>
        <a href="{{ route('home.recipes.index') }}">Recipes</a>
        <a href="">FOODIETY AI</a>
    </div>

    <div class="logo">THE FOODIETY</div>

    <div class="nav-left nav-right">
        <a href="#">About</a>
        <a href="#">Contact</a>
        <a href="#">Follow </a>
        <div class="logoutButton">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="{{ asset('power-off (1).png') }}" alt="BlogIcon">
                <span>Logout</span>
            </a>
        </div>
    </div>
</nav>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Open Sans', sans-serif;
        color: #333;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        background-color: #fff;
        /* Default white background for all pages */
        border-bottom: 1px solid #eee;
        position: fixed;
        top: 0%;
        width: 100%;
        z-index: 100;
        transition: all 0.3s ease;
    }

    /* Homepage specific styles */
    body.homepage .navbar {
        background-color: transparent;
        border-bottom: 1px solid transparent;
    }

    body.homepage .navbar .nav-left a,
    body.homepage .navbar .nav-right a,
    body.homepage .navbar .logo {
        color: white;
    }

    /* Scrolled state for homepage */
    body.homepage .navbar.scrolled {
        background-color: #fff;
        border-bottom: 1px solid #eee;
    }

    body.homepage .navbar.scrolled .nav-left a,
    body.homepage .navbar.scrolled .nav-right a,
    body.homepage .navbar.scrolled .logo {
        color: #333;
    }

    .nav-left {
        display: flex;
        gap: 30px;
    }

    .nav-left a {
        text-decoration: none;
        color: #333;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 600;
        position: relative;
        transition: color 0.3s ease;
        font-family: "Raleway", sans-serif;
    }

    .nav-left a:after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -5px;
        left: 0;
        background-color: currentColor;
        transition: width 0.3s ease;
        color: #ffe600;
    }

    .nav-left a:hover:after {
        width: 100%;
    }

    .nav-right a:last-child:hover:after {
        width: 0%;
    }

    .logo {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #333;
        transition: color 0.3s ease;
    }

    .nav-right {
        display: flex;
        gap: 30px;
    }

    .nav-right a {
        text-decoration: none;
        color: #333;
        font-size: 14px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 600;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-right a img {
        width: 20px;
        height: 20px;
        margin-top: 2px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');

        // Check if we're on the homepage
        if (window.location.pathname === '/') {
            document.body.classList.add('homepage');

            // Add scroll event only for homepage
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        } else {
            // For all other pages, ensure navbar has white background
            navbar.style.backgroundColor = '#fff';
            navbar.style.borderBottom = '1px solid #eee';
        }
    });
</script>
