<nav class="nav">
    <div class="navLeft">
        <ul>
            <li>
                <a class="{{ Request::is('dashboard') ? 'activeNavLink' : '' }}" href="{{ url('/dashboard') }}">
                    <span>Dashboard</span>
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('carousel') ? 'activeNavLink' : '' }}" href="{{ url('/carousel') }}">
                    <span>Carousel</span>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('business') ? 'activeNavLink' : '' }}" href="{{ url('/business') }}">
                    <span>Business</span>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('product') ? 'activeNavLink' : '' }}" href="{{ url('/product') }}">
                    <span>Products</span>
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </a>
            </li>
            <li>
                <a class="{{ Request::is('blog') ? 'activeNavLink' : '' }}" href="{{ url('/blog') }}">
                    <span>Blogs</span>
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </a>
            </li>
        </ul>
    </div>
    <div class="navCenter">
        <a href="/dashboard">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        </a>
    </div>
    <div class="navRight">
        <div class="search">
            <ion-icon name="search-outline"></ion-icon>
            <input type="text" placeholder="Search...">
        </div>
        <div class="userProfile" id="profileButton">
            {{-- <a href="{{ url('/auth/profile') }}"> --}}
                <img src="{{ asset('assets/profile.png') }}" alt="User Profile">
            {{-- </a> --}}
            <div class="profileDropdown" id="profileDropdown">
                <div class="profilePic">
                    <img src="{{ asset('assets/profile.png') }}" alt="">
                    <div class="dropdownUsername">
                        <h3>{{ Auth::user()->name }}</h3>
                        <span>{{ Auth::user()->role }}</span>
                    </div>
                    <ion-icon name="create-outline"></ion-icon>
                </div>
                <hr>
                <a href="{{ route('profile.edit') }}" >
                    <div class="profileItem">
                        <ion-icon name="settings-outline"></ion-icon>
                        <span>Account Settings</span>
                    </div>
                </a>
                <div class="profileItem">
                    <ion-icon name="folder-open-outline"></ion-icon>
                    <span>Manage Projects</span>
                </div>
                <div class="profileItem">
                    <ion-icon name="help-circle-outline"></ion-icon>
                    <span>Help Center</span>
                </div>
                <hr>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="profileItem logout" id="logout">
                        <ion-icon name="power-outline"></ion-icon>
                        <span>Logout</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</nav>

@section('javascript')
    <script>
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        const toggleDropdown = (event) => {
            event.preventDefault();
            event.stopPropagation();
            if (profileDropdown.style.display === 'none' || profileDropdown.style.display === '') {
                profileDropdown.style.display = 'block';
            } else {
                profileDropdown.style.display = 'none';
            }
        };

        profileButton.addEventListener('click', toggleDropdown);

        document.addEventListener('click', (event) => {
            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.style.display = 'none';
            }
        });
    </script>
@endsection

{{-- 
document.addEventListener('DOMContentLoaded', function() {
            const logoutDiv = document.getElementById('logout');

            if (logoutDiv) {
                logoutDiv.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Remove user credentials from localStorage
                    localStorage.removeItem('user');

                    // Create a form to submit the logout request
                    const logoutForm = document.createElement('form');
                    logoutForm.action = '{{ route('auth.logout') }}'; // Use the correct route for logout
                    logoutForm.method = 'POST';

                    // Add CSRF token input
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    logoutForm.appendChild(csrfInput);

                    // Add the form to the body and submit it
                    document.body.appendChild(logoutForm);
                    logoutForm.submit();
                    window.location.href = '/';
                });
            } else {
                console.error('Logout div not found');
            }
        }); --}}