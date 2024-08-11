<nav>
    <div class="navLeft">
        <h3 class="loggedInUserName">
            Welcome back, {{ Auth::user()->name }}
        </h3>
        <span class="span">Monday, 23 November</span>
    </div>
    <div class="navRight">
        <div class="search">
        <img src="{{ asset('dashboardicons/search.png') }}" alt="SearchIcon">
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