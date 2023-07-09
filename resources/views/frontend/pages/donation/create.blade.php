@extends('frontend.layouts.app')

@section('title', 'Donasi Program')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-6 col-12">
                    <form class="custom-form contact-form site-footer" action="#" method="post" role="form">
                        <div class="flex-wrap contact-image-wrap d-flex">
                            <img src="{{ asset('template/frontend/images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg') }}"
                                class="mb-3 custom-text-box-image img-fluid" alt="">
                            <div class="text-center d-flex flex-column">
                                <p class="mb-0 h3 text-light">Anda akan berdonasi untuk :</p>
                                <p class="mb-0 h2 text-light"><strong>Sedekah Bantuan Modal Usaha Untuk Pejuang
                                        Nafkah</strong></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-12">
                                <p class="text-light" style="font-size: 30pt"><strong>Rp. </strong></p>
                            </div>
                            <div class="col-lg-10 col-md-6 col-12">
                                <input type="number" name="last-name" id="last-name" class="form-control text-dark"
                                    placeholder="0" style="font-size: 30pt; font-weight: bold; height:70px;">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-12 col-12 form-check-group form-check-group-donation-frequency">
                                <p class="h4 text-light"><strong>Donatur</strong></p>
                                <select class="form-control text-dark" style="height:50px;">
                                    <option>sdfsdfsdf</option>
                                    <option>sdfsdfsdf</option>
                                    <option>sdfsdfsdf</option>
                                </select>

                                <p class="mb-5 h4 text-light"><strong>081298694640</strong></p>

                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                <label for="vehicle1" class="text-light"> Sembunyikan nama saya (Anonim)</label><br>

                                <textarea name="message" rows="5" class="form-control text-dark" id="message"
                                    placeholder="Tulis dukungan atau do'a untuk penggalangan dana ini. Contoh : Semoga cepet sembuh, ya..."></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-block custom-btn">Lanjut ke Pembayaran</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
