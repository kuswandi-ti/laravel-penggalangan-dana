@extends('frontend.layouts.app')

@section('title', 'Judul Program')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="news-block">
                        <div class="news-block-top">
                            @if (!empty($campaign->path_image))
                                <img src="{{ url('storage' . $campaign->path_image ?? '') }}" class="news-image img-fluid"
                                    alt="" style="width: 100%; max-height: 100%">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="news-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @endif

                            <div class="news-category-block">
                                @if ($campaign->category_campaign)
                                    @foreach ($campaign->category_campaign as $item)
                                        <a class="category-block-link">
                                            {{ $item->name }},
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <form class="custom-form subscribe-form" style="padding: 0px;">
                            <div class="col-lg-12 col-12">
                                <button type="button" class="btn btn-block custom-btn">Donasi Sekarang</button>
                            </div>
                        </form>

                        <div class="news-block-info">
                            <div class="mb-2 news-block-title">
                                <h4>{{ $campaign->title ?? '' }}</h4>
                            </div>

                            <div class="mt-2 d-flex">
                                <div class="news-block-date">
                                    <p>
                                        <i class="bi-calendar4 custom-icon me-1"></i>
                                        {{ date_format_id($campaign->publish_date) ?? '' }}
                                    </p>
                                </div>
                                <div class="mx-5 news-block-author">
                                    <p>
                                        <i class="bi-person custom-icon me-1"></i>
                                        By {{ $campaign->user->name ?? '' }}
                                    </p>
                                </div>
                            </div>

                            <div class="news-block-body">
                                {!! $campaign->body ?? '' !!}
                            </div>
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
                            <a class="nav-link custom-btn btn"
                                href="{{ route('frontend.donation.create', $campaign->id) }}">Donasi
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
