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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/template/frontend/images/logo.png') }}">

    <!-- CSS FILES -->
    <link href="{{ asset('public/template/backend/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/template/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/template/frontend/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/template/frontend/css/templatemo-kind-heart-charity.css') }}" rel="stylesheet">
    <!--
    TemplateMo 581 Kind Heart Charity
    https://templatemo.com/tm-581-kind-heart-charity
    -->

    @stack('style_vendor')

    <style>
        .select2 {
            max-width: 100%;
        }
    </style>

    @stack('style')
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
    <script src="{{ asset('public/template/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/template/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/template/frontend/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('public/template/frontend/js/counter.js') }}"></script>
    <script src="{{ asset('public/template/frontend/js/custom.js') }}"></script>

    @stack('scripts_vendor')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.custom-file-input').on('change', function() {
            let filename = $(this)
                .val()
                .split('\\')
                .pop()
            $(this)
                .next('.custom-file-label')
                .addClass('selected')
                .html(filename)
        })

        function preview(target, image) {
            $(target)
                .attr('src', window.URL.createObjectURL(image))
                .show()
        }
    </script>

    @stack('scripts')
</body>

</html>
