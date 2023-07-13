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
                                <img src="{{ url('storage' . $campaign->path_image ?? '') }}"
                                    class="mb-3 custom-text-box-image img-fluid" alt=""
                                    style="width: 100%; max-height: 100%">
                            @else
                                <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" class="mb-3 custom-text-box-image img-fluid"
                                    alt="" style="width: 100%; max-height: 100%">
                            @endif

                            <x-alert-message style="font-size: 30pt; font-weight: bold;" />

                            <div class="text-center d-flex flex-column">
                                <p class="mb-0 h3 text-light">Anda sudah berdonasi untuk :</p>
                                <p class="mb-0 h2 text-light"><strong>{{ $campaign->title ?? '' }}</strong></p>
                            </div>
                        </div>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <p class="h4 text-light"><strong>No. Order</strong></p>
                                <span class="text-light" style="font-size: 30pt; font-weight: bold;">
                                    <strong>{{ $donation->order_number }}</strong>
                                </span>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <p class="h4 text-light"><strong>Jumlah Donasi</strong></p>
                                <span class="text-light" style="font-size: 30pt; font-weight: bold;">
                                    <strong>{{ amount_format_id($donation->nominal) }}</strong>
                                </span>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <p class="h4 text-light"><strong>Donatur</strong></p>
                                <p class="text-light" style="font-size: 30pt; font-weight: bold;">
                                    <strong>{{ $donation->user->name }}</strong>
                                </p>
                                <p class="text-light" style="font-size: 20pt; font-weight: bold;">
                                    <strong>{{ $donation->user->phone }}</strong>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center row">
                            <div class="col-lg-12 col-12">
                                <input type="checkbox" id="anonim" name="anonim" value="1"
                                    {{ $donation->anonim == 1 ? 'checked' : '' }}>
                                <label for="anonim" class="text-light"> Sembunyikan nama saya (Anonim)</label><br>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <p class="text-light">
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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.midtrans_client_key') }}"></script>
@endpush

@push('scripts')
    <script>
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay_button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay("{{ Session::get('snap_token') }}", {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endpush
