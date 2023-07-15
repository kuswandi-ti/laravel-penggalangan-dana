<nav class="shadow-lg navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('frontend.home.index') }}">
            @if (!empty($setting))
                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $setting->path_image_logo ?? '') }}" class="logo img-fluid">
            @else
                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="logo img-fluid">
            @endif
            <span>
                {{ $setting->business_name ?? '' }}
                <small>{{ $setting->short_description ?? '' }}</small>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about*') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.about.index') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('donation*') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.donation.index') }}">Donasi Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('news*') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.news.index') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact*') ? 'active' : 'inactive' }}"
                        href="{{ route('frontend.contact.index') }}">Kontak</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link custom-btn custom-border-btn btn"
                        href="{{ route('frontend.campaign.index') }}">Galang Dana</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
