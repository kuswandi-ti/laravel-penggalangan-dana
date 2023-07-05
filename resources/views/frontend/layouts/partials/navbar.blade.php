<nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('frontend.home') }}">
            <img src="{{ asset('template/frontend/images/logo.png') }}" class="logo img-fluid" alt="Kind Heart Charity">
            <span>
                Kind Heart Charity
                <small>Non-profit Organization</small>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.home') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.about') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.about') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.campaigns') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.campaigns') }}">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.news') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.news') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.contact') }}">Kontak</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link custom-btn custom-border-btn btn" href="donate.html">Donasi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
