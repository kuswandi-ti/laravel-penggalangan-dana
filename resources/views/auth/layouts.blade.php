<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($setting->company_name) ? $setting->company_name : config('app.name') }} | @yield('title')
    </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/template/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/template/backend/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition @yield('class_body')">
    <div class="@yield('class_box')">
        <div class="card card-outline card-primary">
            <div class="text-center card-header">
                <a href="{{ route('frontend.home') }}" class="h2">
                    <b>{{ config('app.name') }}</b>
                </a>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('public/template/backend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/template/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/template/backend/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
