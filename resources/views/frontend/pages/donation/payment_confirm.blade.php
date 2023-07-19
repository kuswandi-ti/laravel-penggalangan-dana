@extends('frontend.layouts.app')

@section('title', 'Konfirmasi Pembayaran Donasi')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6 col-12">
                    <form class="custom-form contact-form site-footer">
                        <div class="text-center d-flex flex-column">
                            <h1 class="text-warning">Terima Kasih !</h1>
                        </div>
                        <div class="flex-wrap contact-image-wrap d-flex">
                            @if (!empty($campaign->path_image))
                                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $campaign->path_image ?? '') }}"
                                    class="mb-3 custom-text-box-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="mb-3 custom-text-box-image img-fluid"
                                    alt="" style="width: 100%; max-height: 100%">
                            @endif

                            <div class="d-flex flex-column">
                                <p class="mb-0 h3 text-light">Anda sudah berdonasi untuk :</p>
                                <p class="mb-0 h2 text-warning"><strong>{{ $campaign->title ?? '' }}</strong></p>
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

                        <hr>

                        <a href="{{ route('frontend.donation.index') }}" class="btn btn-block custom-btn"
                            id="confirm_button">Kembali ke Halaman Donasi &nbsp;<span id="countdown"></span></a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        var counter = 11;

        $(document).ready(function() {
            var interval = setInterval(function() {
                counter--;
                $("#countdown").html(counter);
                if (counter == 1) {
                    window.location.href = "{{ route('frontend.donation.index') }}"
                    clearInterval(interval);
                }
            }, 1000);
        });
    </script>
@endpush
