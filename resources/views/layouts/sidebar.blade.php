@php
    $unvisitedMessageCount = App\Models\Message::where('status', 'unvisited')->count();
@endphp
<aside>
    <div class="sidebarContainer">
        <a href="#">
            <img src="{{ asset('dashboardicons/logo.png') }}" alt="Logo">
        </a>
    </div>
    <div class="sidebarNavItems">
        <ul>
            <li class="{{ Request::is('dashboard') ? 'activeNavLink' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">
                <img src="{{ asset('home-agreement.png') }}" alt="HomeIcon">
                    <span>Dashboard</span>
                </a>
            </li>
            <h3 class="sidebarSubHeading store">Home</h3>
            <li class="{{ Request::is('carousel') ? 'activeNavLink' : '' }}">
                <a  href="{{ url('/carousel') }}">
                <img src="{{ asset('carousel.png') }}" alt="CarouselIcon">
                    <span>Carousel</span>
                </a>
            </li>
            <li class="{{ Request::is('business') ? 'activeNavLink' : '' }}">
                <a  href="{{ url('/business') }}">
                <img src="{{ asset('info.png') }}" alt="AboutIcon">
                    <span>About</span>
                </a>
            </li>
            <li class="{{ Request::is('services') ? 'activeNavLink' : '' }}">
                <a  href="{{ url('/services') }}">
                <img src="{{ asset('24-hours.png') }}" alt="AboutIcon">
                    <span>Services</span>
                </a>
            </li>
            <h3 class="sidebarSubHeading store">Manage Users</h3>
            <li class="{{ Request::is('users') ? 'activeNavLink' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <img src="{{ asset('add (1).png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Users</span>
                </a>
            </li>
            <h3 class="sidebarSubHeading store">Categories</h3>
            <li class="{{ Request::is('categories') ? 'activeNavLink' : '' }}">
                <a href="{{ route('categories.index') }}" class="nav-link">
                    <img src="{{ asset('menu.png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Categories</span>
                </a>
            </li>
            <h3 class="sidebarSubHeading store">Services</h3>
            <li class="{{ Request::is('restaurants') ? 'activeNavLink' : '' }}">
                <a  href="{{ url('/restaurants') }}">
                <img src="{{ asset('restaurant.png') }}" alt="ProductIcon">
                    <span>Restaurants</span>
                </a>
            </li>
            <li class="{{ Request::is('blogs') ? 'activeNavLink' : '' }}">
                <a href="{{ url('/blogs') }}" class="nav-link">
                    <img src="{{ asset('trending.png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Blogs</span>
                </a>
            </li>
            <li class="{{ Request::is('recipes') ? 'activeNavLink' : '' }}">
                <a href="{{ url('/recipes') }}" class="nav-link">
                    <img src="{{ asset('ingredients.png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Recipes</span>
                </a>
            </li>
            <li class="{{ Request::is('galleries') ? 'activeNavLink' : '' }}">
                <a href="{{ route('galleries.index')}}" class="nav-link">
                    <img src="{{ asset('apple.png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Galleries</span>
                </a>
            </li>
            <li class="{{ Request::is('ais') ? 'activeNavLink' : '' }}">
                <a href="{{ route('ais.index')}}" class="nav-link">
                    <img src="{{ asset('magic-wand.png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Foodiety AI</span>
                </a>
            </li>
            <li class="{{ Request::is('videos') ? 'activeNavLink' : '' }}">
                <a href="{{ route('videos.index')}}" class="nav-link">
                    <img src="{{ asset('streaming.png') }}" alt="Blog Icon" class="nav-icon">
                    <span>Videos</span>
                </a>
            </li>


            <li class="{{ Request::is('messages') ? 'activeNavLink' : '' }}">
                <a href="{{ url('/messages') }}">
                <img src="{{ asset('comment.png') }}" alt="ChatIcon">
                    <span>Messages</span>
                </a>
                
                @if($unvisitedMessageCount > 0)
                    <div class="messageNum">{{ $unvisitedMessageCount }}</div>
                @endif
            </li>

            {{-- USER PROFILE --}}
            <div class="sideBarProfile">
                <h3 class="sidebarSubHeading">Profile / Account</h3>
                <li class="{{ Request::is('profile') ? 'activeNavLink' : '' }}">
                    <a  href="{{ url('/profile') }}">
                    <img src="{{ asset('profile.png') }}" alt="ProfileIcon">
                        <span>Profile</span>
                    </a>
                </li>
                
                <li class="{{ Request::is('setting') ? 'activeNavLink' : '' }}">
                    <a  href="{{ url('/setting') }}">
                    <img src="{{ asset('settings.png') }}" alt="manageIcon">
                        <span>Settings</span>
                    </a>
                </li>
            </div>
            {{-- LOG OUT --}}
            <div class="logoutButton">
                <h3 class="sidebarSubHeading">Logout / Exit</h3>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li id="logout">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('power-off (1).png') }}" alt="BlogIcon">
                        <span>Logout</span>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</aside>
