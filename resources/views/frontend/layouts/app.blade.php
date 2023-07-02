<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hafsa Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/frontend/assets/images/x-icon/01.png') }}">

    <link rel="stylesheet" href="{{ asset('template/frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/frontend/assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/frontend/assets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('template/frontend/assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/frontend/assets/css/style.css') }}">

    @stack('styles')
</head>

<body>
    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->

    <!-- Header Section Starts Here -->
    <header class="header-3 pattern-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-3 col-12">
                    <div class="flex-wrap mobile-menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="header-bar d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{ asset('template/frontend/assets/images/logo/01.png') }}" alt="logo">
                            </a>
                        </div>
                        <div class="ellepsis-bar d-lg-none">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-12">
                    <div class="header-top">
                        <div class="header-top-area">
                            <ul class="left lab-ul">
                                <li>
                                    <i class="icofont-ui-call"></i> <span>+800-123-4567 6587</span>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i> Beverley, New York 224 US
                                </li>
                            </ul>
                            <ul class="social-icons lab-ul d-flex">
                                <li>
                                    <a href="#"><i class="fab fa-facebook-messenger"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-vimeo-v"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-skype"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fas fa-wifi"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-bottom">
                        <div class="header-wrapper">
                            <div class="menu-area justify-content-between w-100">
                                <ul class="menu lab-ul">
                                    <li>
                                        <a href="{{ route('frontend.home') }}">Home</a>
                                    </li>
                                    <li><a href="{{ route('frontend.contact') }}">Kontak</a></li>
                                    <li>
                                        <a href="{{ route('frontend.about') }}">Tentang Kami</a>
                                    </li>
                                    <li>
                                        <a href="#0">Bantuan</a>
                                        <ul class="submenu">
                                            <li> <a href="programs.html">Programs</a></li>
                                            <li><a href="program-single.html">Program Single</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="prayer-time d-none d-lg-block">
                                    <a href="#" class="prayer-time-btn">
                                        Donasi
                                    </a>
                                    <a href="#" class="prayer-time-btn">
                                        Galang Dana
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section Ends Here-->

    @if (Route::is('frontend.home'))
        @includeIf('frontend.layouts.partials.banner')
    @else
        @includeIf('frontend.layouts.partials.page_header')
    @endif

    @yield('content')

    @includeIf('frontend.layouts.partials.footer')

    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-bubble-up"></i><span class="pluse_1"></span><span
            class="pluse_2"></span></a>
    <!-- scrollToTop ending here -->

    <script src="{{ asset('template/frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/circularProgressBar.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/lightcase.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/js/functions.js') }}"></script>

    @stack('scripts')
</body>

</html>
