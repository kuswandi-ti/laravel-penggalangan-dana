<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ !empty($setting->business_name) ? $setting->business_name : config('app.name') }} | @yield('title')
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
</head>

<body>
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6 col-12">
                    <form class="custom-form contact-form site-footer">
                        <div class="text-center d-flex flex-column">
                            <h1 class="text-warning">Terima Kasih !</h1>
                        </div>
                        <div class="flex-wrap contact-image-wrap d-flex">
                            @if (!empty($donation->campaign->path_image))
                                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $donation->campaign->path_image ?? '') }}"
                                    class="mb-3 custom-text-box-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                                    class="mb-3 custom-text-box-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @endif

                            <div class="d-flex flex-column">
                                <p class="mb-0 h3 text-light">Anda sudah berdonasi untuk :</p>
                                <p class="mb-0 h2 text-warning"><strong>{{ $donation->campaign->title ?? '' }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <p class="h4 text-light"><strong>No. Order</strong></p>
                                <span class="text-warning" style="font-size: 30pt; font-weight: bold;">
                                    <strong>{{ $donation->order_number }}</strong>
                                </span>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <p class="h4 text-light"><strong>Jumlah Donasi</strong></p>
                                <span class="text-warning" style="font-size: 30pt; font-weight: bold;">
                                    <strong>{{ amount_format_id($donation->nominal) }}</strong>
                                </span>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <p class="h4 text-light"><strong>Donatur</strong></p>
                                <p class="text-warning" style="font-size: 30pt; font-weight: bold;">
                                    <strong>{{ $donation->anonim == 1 ? 'Anomim' : $donation->user->name }}</strong>
                                </p>
                                <p class="text-warning" style="font-size: 20pt; font-weight: bold;">
                                    <strong>{{ $donation->anonim == 1 ? '' : $donation->user->phone }}</strong>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <p class="text-warning">
                                    {!! $donation->support !!}
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
