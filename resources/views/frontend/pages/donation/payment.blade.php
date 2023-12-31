@extends('frontend.layouts.app')

@section('title', 'Pembayaran Donasi')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6 col-12">
                    <form class="custom-form contact-form site-footer" action="#" method="post" role="form"
                        id="payment-form">
                        @csrf
                        <div class="flex-wrap contact-image-wrap d-flex">
                            @if (!empty($campaign->path_image))
                                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $campaign->path_image ?? '') }}"
                                    class="mb-3 custom-text-box-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="mb-3 custom-text-box-image img-fluid"
                                    alt="" style="width: 100%; max-height: 100%">
                            @endif

                            <x-alert-message style="font-size: 30pt; font-weight: bold;" />

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
                                @if ($donation->anonim == 1)
                                    <p class="text-warning" style="font-size: 30pt; font-weight: bold;">
                                        <strong>Anonim</strong>
                                    </p>
                                @else
                                    <p class="text-warning" style="font-size: 30pt; font-weight: bold;">
                                        <strong>{{ $donation->user->name }}</strong>
                                    </p>
                                    <p class="text-warning" style="font-size: 20pt; font-weight: bold;">
                                        <strong>{{ $donation->user->phone }}</strong>
                                    </p>
                                @endif
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

                        <button type="button" class="btn btn-block custom-btn" id="pay_button">Lakukan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_vendor')
    <script src="{{ config('midtrans.midtrans_snap_url') }}" data-client-key="{{ config('midtrans.midtrans_client_key') }}">
    </script>
@endpush

@push('scripts')
    <script>
        var payButton = document.getElementById('pay_button');
        payButton.addEventListener('click', function() {
            window.snap.pay("{{ Session::get('snap_token') }}", {
                onSuccess: function(result) {
                    // alert("payment success!");
                    // console.log(result);
                    window.location.href =
                        '/donation/{{ $campaign->id }}/payment_confirm/{{ $donation->order_number }}';
                },
                onPending: function(result) {
                    // alert("wating your payment!");
                    // console.log(result);
                },
                onError: function(result) {
                    // alert("payment failed!");
                    // console.log(result);
                },
                onClose: function() {
                    // alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endpush
