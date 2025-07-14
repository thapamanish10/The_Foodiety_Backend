@props(['type' => 'all'])

<section class="main-sub-heading">
    <div class="main-sub-heading-section">
        <p>All Posts</p>
        {{-- <p>Christmas</p>
        <p>Thanksgiving</p>
        <p>Halloween</p>
        <p>Easter</p> --}}
    </div>
    <div class="main-sub-heading-section">
        <div class="main-sub-heading-section-search-box">
            <form action="{{ route('search') }}" method="GET" class="main-sub-heading-section-search-box-card"
                id="searchBox">
                @csrf
                <img src="{{ url('/search (2).png') }}" alt="Search icon" id="searchIcon2" style="display: none;">
                <input type="hidden" name="type" value="{{ $type }}">
                <img src="{{ url('/search (2).png') }}" alt="Search icon" id="searchIcon">
                <input type="search" name="query" autofocus placeholder="Search..." value="{{ request('query') }}"
                    id="searchField" style="display: none;">
            </form>
            <img src="{{ url('/close.png') }}" id="closeBtn" alt="Close button" style="display: none;">
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchForm = document.getElementById('searchBox');
                const searchInput = document.getElementById('searchField');
                const searchIcon = document.getElementById('searchIcon');
                const searchIcon2 = document.getElementById('searchIcon2');
                const typeInput = searchForm.querySelector('input[name="type"]');
                const closeBtn = document.getElementById('closeBtn');
                const hasQuery = searchInput.value.trim() !== '';

                // Initialize based on current query
                if (hasQuery) {
                    searchInput.style.display = 'block';
                    closeBtn.style.display = 'inline';
                    searchIcon.style.display = 'none';
                    searchIcon2.style.display = 'block';
                }

                // Store the current type in localStorage when page loads
                if (typeInput.value === 'blog' || typeInput.value === 'recipe') {
                    localStorage.setItem('lastSearchType', typeInput.value);
                }

                // Handle form submission
                searchForm.addEventListener('submit', function(e) {
                    if (searchInput.value.trim() === '') {
                        e.preventDefault();
                        resetSearch();
                    } else {
                        // Only store valid types
                        if (typeInput.value === 'blog' || typeInput.value === 'recipe') {
                            localStorage.setItem('lastSearchType', typeInput.value);
                        }
                    }
                });

                // Show search input when search icon is clicked
                searchIcon.addEventListener('click', function() {
                    searchInput.style.display = 'block';
                    closeBtn.style.display = 'inline';
                    searchIcon.style.display = 'none';
                    searchIcon2.style.display = 'block';
                    searchInput.focus();
                });

                // Close button behavior
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (searchInput.value.trim() === '') {
                        // Hide search if empty
                        searchInput.style.display = 'none';
                        closeBtn.style.display = 'none';
                        searchIcon.style.display = 'inline';
                        searchIcon2.style.display = 'none';
                    } else {
                        // Clear search if has content
                        resetSearch();
                    }
                });

                // Function to completely reset search
                function resetSearch() {
                    searchInput.value = '';
                    // Get the last valid search type from localStorage
                    const lastType = localStorage.getItem('lastSearchType');

                    // Redirect to appropriate index based on type
                    if (lastType === 'recipe') {
                        window.location.href = "{{ route('home.recipes.index') }}";
                    } else {
                        // Default to blogs index for 'blog' or any other case
                        window.location.href = "{{ route('home.blogs.index') }}";
                    }
                }
            });
        </script>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .main-sub-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 3rem auto;
    }

    .main-sub-heading-section {
        width: 50%;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .main-sub-heading-section:nth-child(2) {
        justify-content: flex-end
    }

    .main-sub-heading-section p {
        font-size: 16px;
        color: #5f5f5f;
        padding: 3px 5px;
        font-family: "Playfair Display", serif;
        cursor: pointer;
        white-space: nowrap;
    }

    .main-sub-heading-section-search-box {
        display: flex;
        gap: 1rem;
    }

    .main-sub-heading-section-search-box-card {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .main-sub-heading-section-search-box input {
        width: 250px;
        padding: 3px 5px;
        border: none;
        outline: none;
        font-size: 14px;
        font-family: "Playfair Display", serif;
    }

    .main-sub-heading-section-search-box img {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    @media (max-width: 600px) {
        .main-sub-heading {
            display: flex;
            align-items: flex-end;
            margin: 0 .5rem;
        }

        .main-sub-heading-section {
            width: 100%;
            align-items: flex-start;
            padding: 1rem 0;
        }
    }
</style>
