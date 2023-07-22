<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="flex-wrap col-lg-6 col-12 d-flex justify-content-start">
                <p class="mb-0 d-flex me-4">
                    <i class="bi-geo-alt me-2"></i>
                    {{ $setting->address ?? '' }}
                </p>
                <p class="mb-0 d-flex">
                    <i class="bi-envelope me-2"></i>
                    <a href="mailto:{{ $setting->email ?? '' }}" target="_blank">
                        {{ $setting->email ?? '' }}
                    </a>
                </p>
            </div>
            <div class="flex-wrap col-lg-3 col-12 d-flex justify-content-center">
                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="{{ $setting->instagram_link ?? '' }}" class="social-icon-link bi-instagram"
                            target="_blank"></a>
                    </li>
                    <li class="social-icon-item">
                        <a href="{{ $setting->twitter_link ?? '' }}" class="social-icon-link bi-twitter"
                            target="_blank"></a>
                    </li>
                    <li class="social-icon-item">
                        <a href="{{ $setting->google_plus_link ?? '' }}" class="social-icon-link bi-google"
                            target="_blank"></a>
                    </li>
                    <li class="social-icon-item">
                        <a href="{{ $setting->youtube_link ?? '' }}" class="social-icon-link bi-youtube"
                            target="_blank"></a>
                    </li>
                    <li class="social-icon-item">
                        <a href="{{ $setting->facebook_link ?? '' }}" class="social-icon-link bi-facebook"
                            target="_blank"></a>
                    </li>
                    <li class="social-icon-item">
                        <a href="https://wa.me/{{ $setting->phone ?? '' }}" class="social-icon-link bi-whatsapp"
                            target="_blank"></a>
                    </li>
                </ul>
            </div>

            <div class="flex-wrap text-right col-lg-3 col-12 d-flex justify-content-end">
                @auth
                    <p class="mb-0 d-flex me-4">
                        <a href="{{ route('backend.dashboard') }}">
                            Dashboard
                        </a>
                    </p>
                    <p class="mb-0 d-flex me-4">
                        <a href="#" onclick="document.querySelector('#form-logout').submit()" role="button">
                            Logout
                        </a>
                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        @csrf
                    </form>
                    </p>
                @else
                    <p class="mb-0 d-flex me-4">
                        <a href="{{ route('login') }}">
                            Login
                        </a>
                    </p>
                    <p class="mb-0 d-flex">
                        <a href="{{ route('register') }}">
                            Register
                        </a>
                    </p>
                @endauth
            </div>
        </div>
    </div>
</header>
