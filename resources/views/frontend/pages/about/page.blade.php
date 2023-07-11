<section class="section-padding section-bg">
    <div class="container">
        <div class="row">
            <div class="mb-3 col-lg-6 col-12 mb-lg-0">
                <img src="{{ asset('template/frontend/images/group-people-volunteering-foodbank-poor-people.jpg') }}"
                    class="custom-text-box-image img-fluid" alt="">
            </div>

            <div class="col-lg-6 col-12">
                <div class="custom-text-box">
                    <h2 class="mb-2">Tentang Kami</h2>
                    <h5 class="mb-3"><span class="text-secondary">{{ $setting->business_name ?? '' }}</span>,
                        {{ $setting->short_description ?? '' }}
                    </h5>
                    <p class="mb-0">
                        {!! $setting->about ?? '' !!}
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="custom-text-box mb-lg-0">
                            <h5 class="mb-3">Misi Kami</h5>
                            {!! $setting->vision ?? '' !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="flex-wrap custom-text-box d-flex d-lg-block mb-lg-0">
                            <div class="counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="{{ $donatur_count ?? 0 }}"
                                        data-speed="1000"></span>
                                    <span class="counter-number-text"></span>
                                </div>
                                <span class="counter-text">Donatur</span>
                            </div>

                            <div class="mt-4 counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1"
                                        data-to="{{ amount_format_id($donation_sum ?? 0) / 1000000 }}"
                                        data-speed="1000"></span>
                                    <span class="counter-number-text">jt</span>
                                </div>
                                <span class="counter-text">Donasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
