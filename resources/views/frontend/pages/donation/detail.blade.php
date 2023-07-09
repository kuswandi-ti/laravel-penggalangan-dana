@extends('frontend.layouts.app')

@section('title', 'Judul Program')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="news-block">
                        <div class="news-block-top">
                            <img src="{{ asset('template/frontend/images/news/medium-shot-volunteers-with-clothing-donations.jpg') }}"
                                class="news-image img-fluid" alt="">

                            <div class="news-category-block">
                                <a href="#" class="category-block-link">
                                    Lifestyle,
                                </a>

                                <a href="#" class="category-block-link">
                                    Clothing Donation
                                </a>
                            </div>
                        </div>

                        <form class="custom-form subscribe-form" style="padding: 0px;">
                            <div class="col-lg-12 col-12">
                                <button type="button" class="btn btn-block custom-btn">Donasi Sekarang</button>
                            </div>
                        </form>

                        <div class="news-block-info">
                            <div class="mb-2 news-block-title">
                                <h4>Clothing donation to urban area</h4>
                            </div>

                            <div class="mt-2 d-flex">
                                <div class="news-block-date">
                                    <p>
                                        <i class="bi-calendar4 custom-icon me-1"></i>
                                        October 12, 2036
                                    </p>
                                </div>
                                <div class="mx-5 news-block-author">
                                    <p>
                                        <i class="bi-person custom-icon me-1"></i>
                                        By Admin
                                    </p>
                                </div>
                            </div>

                            <div class="news-block-body">
                                <p><strong>Lorem Ipsum</strong> dolor sit amet, consectetur adipsicing kengan omeg
                                    kohm tokito Professional charity theme based on Bootstrap</p>

                                <p><strong>Sed leo</strong> nisl, This is a Bootstrap 5.2.2 CSS template for charity
                                    organization websites. You can feel free to use it. Please tell your friends
                                    about TemplateMo website. Thank you.</p>

                                <blockquote>Sed leo nisl, posuere at molestie ac, suscipit auctor mauris. Etiam quis
                                    metus elementum, tempor risus vel, condimentum orci.</blockquote>
                            </div>

                            <div class="mt-5 mb-4 row">
                                <div class="mb-4 col-lg-6 col-12 mb-lg-0">
                                    <img src="images/news/africa-humanitarian-aid-doctor.jpg"
                                        class="news-detail-image img-fluid" alt="">
                                </div>

                                <div class="col-lg-6 col-12">
                                    <img src="images/news/close-up-happy-people-working-together.jpg"
                                        class="news-detail-image img-fluid" alt="">
                                </div>
                            </div>

                            <p>You are not allowed to redistribute this template ZIP file on any other template
                                collection website. Please <a href="https://templatemo.com/contact" target="_blank">contact
                                    TemplateMo</a> for more information.</p>
                        </div>
                    </div>
                </div>

                <div class="mx-auto col-lg-4 col-12 mt-lg-0">
                    <h5>Status</h5>
                    <span class="mb-4 h2"><strong>Rp. {{ amount_format_id(10000000) }}</strong></span><br>
                    <span class="mb-5 h5">Terkumpul dari Rp. {{ amount_format_id(15000000) }}</span>

                    <div class="mt-4 progress">
                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                            aria-valuemax="100" height="100"></div>
                    </div>
                    <div class="my-2 d-flex align-items-center">
                        <p class="mb-0">
                            <strong>7%</strong>
                            Tercapai
                        </p>

                        <p class="mb-0 ms-auto">
                            <strong>3 bulan</strong>
                            lagi
                        </p>
                    </div>
                    <form class="custom-form subscribe-form" style="padding: 0px;">
                        <div class="col-lg-12 col-12">
                            <a class="nav-link custom-btn btn" href="{{ route('frontend.donation.create') }}">Donasi
                                Sekarang</a>
                        </div>
                    </form>

                    <form class="custom-form subscribe-form">
                        <h5 class="mb-3">Waktu</h5>
                        <ul class="mt-2 custom-list">
                            <li class="custom-list-item d-flex">
                                <i class="bi-check custom-text-box-icon me-2"></i>
                                Charity Theme
                            </li>

                            <li class="custom-list-item d-flex">
                                <i class="bi-check custom-text-box-icon me-2"></i>
                                Semantic HTML
                            </li>
                        </ul>
                    </form>

                    <form class="custom-form subscribe-form">
                        <h5 class="mb-3">Jumlah</h5>
                        <ul class="mt-2 custom-list">
                            <li class="custom-list-item d-flex">
                                <i class="bi-check custom-text-box-icon me-2"></i>
                                Charity Theme
                            </li>

                            <li class="custom-list-item d-flex">
                                <i class="bi-check custom-text-box-icon me-2"></i>
                                Semantic HTML
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
