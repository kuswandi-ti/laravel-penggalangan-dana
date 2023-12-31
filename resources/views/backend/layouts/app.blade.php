<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($setting->company_name) ? $setting->company_name : config('app.name') }} | @yield('title')
    </title>

    <link rel="icon"
        href="{{ url(env('PATH_IMAGE_STORAGE') . (!empty($setting->path_image_logo) ? $setting->path_image_logo : '') ?? '') }}"
        type="image/*">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/template/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('public/template/backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @stack('styles_vendor')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/template/backend/dist/css/adminlte.min.css') }}">

    <style>
        .note-editor {
            margin-bottom: 0;
        }

        .note-editor.is-invalid {
            border-color: var(--danger);
        }

        .select2 {
            max-width: 100%;
        }
    </style>

    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('public/template/backend/dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @includeIf('backend.layouts.partials.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @includeIf('backend.layouts.partials.sidebar')
        <!-- /.main sidebar container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                @show
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @includeIf('backend.layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('public/template/backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/template/backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/template/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('public/template/backend/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('public/template/backend/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('public/template/backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('public/template/backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('public/template/backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/template/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
    </script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('public/template/backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Moment -->
    <script src="{{ asset('public/template/backend/plugins/moment/moment.min.js') }}"></script>

    @stack('scripts_vendor')

    <!-- AdminLTE App -->
    <script src="{{ asset('public/template/backend/dist/js/adminlte.js') }}"></script>

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
