<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ !empty($setting->company_name) ? $setting->company_name : config('app.name') }} | @yield('title')
    </title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/frontend/images/logo.png') }}">

    <!-- CSS FILES -->
    <link href="{{ asset('template/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/frontend/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/frontend/css/templatemo-kind-heart-charity.css') }}" rel="stylesheet">
    <!--
    TemplateMo 581 Kind Heart Charity
    https://templatemo.com/tm-581-kind-heart-charity
    -->
</head>

<body>
    @includeIf('frontend.layouts.partials.header')

    @includeIf('frontend.layouts.partials.navbar')

    <main>
        @if (Route::is('frontend.home'))
            @yield('content')
        @else
            @includeIf('frontend.layouts.partials.page_title')
            @yield('content')
        @endif
    </main>

    @includeIf('frontend.layouts.partials.footer')

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('template/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/frontend/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('template/frontend/js/counter.js') }}"></script>
    <script src="{{ asset('template/frontend/js/custom.js') }}"></script>
</body>

</html>
