<nav class="shadow-lg navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('frontend.home') }}">
            <img src="{{ url('storage' . $setting->path_image_logo ?? '') }}" class="logo img-fluid">
            <span>
                {{ $setting->company_name }}
                <small>{{ $setting->company_name }}</small>
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
                    <a class="nav-link {{ request()->routeIs('frontend.donation') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.donation') }}">Donasi Program</a>
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
                    <a class="nav-link custom-btn custom-border-btn btn"
                        href="{{ route('frontend.campaign.index') }}">Galang Dana</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
