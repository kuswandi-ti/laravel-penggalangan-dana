@extends('frontend.layouts.app')

@section('title', 'Donasi Program')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6 col-12">
                    <form class="custom-form contact-form site-footer"
                        action="{{ route('frontend.donation.checkout', $campaign->id) }}" method="post" role="form"
                        id="donation-form">
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
                            <div class="text-center d-flex flex-column">
                                <p class="mb-0 h3 text-light">Anda akan berdonasi untuk :</p>
                                <p class="mb-0 h2 text-light"><strong>{{ $campaign->title ?? '' }}</strong></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-12">
                                <p class="text-light" style="font-size: 30pt"><strong>Rp. </strong></p>
                            </div>
                            <div class="col-lg-10 col-md-6 col-12">
                                <input type="number" name="nominal" id="nominal"
                                    class="form-control text-dark @error('nominal') is-invalid @enderror" placeholder="0"
                                    style="font-size: 30pt; font-weight: bold; height:70px;">
                                @error('nominal')
                                    <div class="invalid-feedback mb-3">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-12 form-check-group form-check-group-donation-frequency">
                                @if (auth()->user()->hasRole('admin'))
                                    <p class="h4 text-light"><strong>Donatur</strong></p>
                                    <select class="form-control text-dark @error('user_id') is-invalid @enderror"
                                        name="user_id" id="user_id" style="height:50px;">
                                        <option disabled selected>Pilih salah satu</option>
                                        @foreach ($donatur as $item)
                                            <option value="{{ $item->id }}" data-phone="{{ $item->phone }}"
                                                {{ old('user_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="form-group mb-2 phone" style="display: none;">
                                        <p class="h4 text-light"><strong>No. Telp.</strong></p>
                                        <label class="h4 text-light"></label>
                                    </div>
                                @else
                                    <input type="hidden" name="user_id" value="{{ auth()->id }}">
                                    <div class="form-group mb-0">
                                        <p class="h4 text-light"><strong>No. Telp.</strong></p>
                                        <label class="h4 text-light">{{ auth()->user()->phone }}</label>
                                    </div>
                                @endif

                                <input type="checkbox" id="anonim" name="anonim" value="1"
                                    {{ old('anonim') == 1 ? 'checked' : '' }}>
                                <label for="anonim" class="text-light"> Sembunyikan nama saya (Anonim)</label><br>

                                <textarea name="support" rows="5" class="form-control text-dark" id="support"
                                    placeholder="Tulis dukungan atau do'a untuk penggalangan dana ini. Contoh : Semoga cepet sembuh, ya..."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block custom-btn">Lanjut ke Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('[name=user_id]').on('change', function() {
            let value = $(this).val();
            let phone = $(`[name=user_id] option[value=${value}]`).data('phone')

            $('.phone').show()
            $('.phone label').text(phone);
        });
    </script>
@endpush
