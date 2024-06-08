<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand text-white" href="{{ route('home') }}">Movies Website</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('topRating') }}">Top Rating </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('suggested') }}">Suggested</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('favorite') }}"> favorite</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('aprior.index') }}"> Aprior</a>
        </li>
        <li class="nav-item">
            <div class="search-container">
                <form action="/search" method="POST">
                    @csrf
                    <input type="text" class="search-box" placeholder="Search..." name="search">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </li>
    </ul>
</nav>
