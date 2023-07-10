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
                    <h5 class="mb-3"><span class="text-secondary">{{ $setting->company_name ?? '' }}</span>,
                        Organisasi Non Profit
                    </h5>
                    <p class="mb-0">
                        {!! $setting->about ?? '' !!}
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="custom-text-box mb-lg-0">
                            <h5 class="mb-3">Misi Kami</h5>
                            <p>Sed leo nisl, posuere at molestie ac, suscipit auctor quis metus</p>
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
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="flex-wrap custom-text-box d-flex d-lg-block mb-lg-0">
                            <div class="counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="2009" data-speed="1000"></span>
                                    <span class="counter-number-text"></span>
                                </div>
                                <span class="counter-text">Founded</span>
                            </div>

                            <div class="mt-4 counter-thumb">
                                <div class="d-flex">
                                    <span class="counter-number" data-from="1" data-to="120" data-speed="1000"></span>
                                    <span class="counter-number-text">B</span>
                                </div>
                                <span class="counter-text">Donations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
