@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero-section hero-section-full-height">
        <div class="container-fluid">
            <div class="row">
                <div class="p-0 col-lg-12 col-12">
                    <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($banners as $item)
                                <div class="carousel-item active">
                                    @if (!empty($setting))
                                        <img src="{{ url('storage' . $setting->banner_image ?? '') }}"
                                            class="carousel-image img-fluid" alt="">
                                    @else
                                        <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="carousel-image img-fluid">
                                    @endif
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>{{ $item->banner_title ?? '' }}</h1>
                                        <p>{{ $item->banner_description ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#hero-slide"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="mx-auto text-center col-lg-10 col-12">
                    <h2 class="mb-5">Selamat datang di {{ $setting->business_name ?? '' }}</h2>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/hands.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Penerimaan <br><strong>Relawan</strong></p>
                        </a>
                    </div>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0 mb-md-4">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/heart.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Kegiatan <br><strong>Keagamaan</strong></p>
                        </a>
                    </div>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0 mb-md-4">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/receive.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Penerimaan <br><strong>Donasi</strong></p>
                        </a>
                    </div>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/scholarship.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Pondok <br><strong>Pesantren</strong></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @includeIf('frontend.pages.about.page')

    @includeIf('frontend.pages.donation.page')

    @includeIf('frontend.pages.contact.page')
@endsection
