<aside>
    <div class="sidebarContainer">
        <a href="/dashboard">
            <img src="{{ asset('dashboardicons/logo.png') }}" alt="Logo">
        </a>
    </div>
    <div class="sidebarNavItems">
        <ul>
            <li class="{{ Request::is('dashboard') ? 'activeNavLink' : '' }}">
                <img src="{{ asset('dashboardicons/home.png') }}" alt="HomeIcon">
                <a href="{{ url('/dashboard') }}">
                    <span>Dashboard</span>
                </a>
            </li>
            <h3 class="sidebarSubHeading">My Store</h3>
            <li class="{{ Request::is('product') ? 'activeNavLink' : '' }}">
                <img src="{{ asset('dashboardicons/product.png') }}" alt="ProductIcon">
                <a  href="{{ url('/product') }}">
                    <span>Products</span>
                </a>
            </li>
            <li class="{{ Request::is('carousel') ? 'activeNavLink' : '' }}">
                <img src="{{ asset('dashboardicons/carousel.png') }}" alt="CarouselIcon">
                <a  href="{{ url('/carousel') }}">
                    <span>Carousel</span>
                </a>
            </li>
            <li class="{{ Request::is('business') ? 'activeNavLink' : '' }}">
                <img src="{{ asset('dashboardicons/about.png') }}" alt="AboutIcon">
                <a  href="{{ url('/business') }}">
                    <span>Business</span>
                </a>
            </li>
            
            <li class="{{ Request::is('blog') ? 'activeNavLink' : '' }}">
                <img src="{{ asset('dashboardicons/blog.png') }}" alt="BlogIcon">
                <a  href="{{ url('/blog') }}">
                    <span>Blogs</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
