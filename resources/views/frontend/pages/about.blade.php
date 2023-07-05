@extends('frontend.layouts.app')

@section('title', 'Tentang Kami')

@section('content')
    <section class="section-padding section-bg" id="section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 mb-5 mb-lg-5">
                    <img src="{{ asset('template/frontend/images/group-people-volunteering-foodbank-poor-people.jpg') }}"
                        class="custom-text-box-image img-fluid" alt="">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="custom-text-box">
                        <h2 class="mb-2">Our Story</h2>
                        <h5 class="mb-3">Kind Heart Charity, Non-Profit Organization</h5>
                        <p class="mb-0">This is a Bootstrap 5.2.2 CSS template for charity organization websites.
                            You can feel free to use it. Please tell your friends about TemplateMo website. Thank
                            you. HTML CSS files updated on 20 Oct 2022.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="custom-text-box">
                        <h5 class="mb-3">Our Mission</h5>
                        <p>Sed leo nisl, posuere at molestie ac, suscipit auctor quis metus</p>
                        <ul class="custom-list mt-2">
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
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="custom-text-box d-flex flex-wrap">
                        <div class="counter-thumb">
                            <div class="d-flex">
                                <span class="counter-number" data-from="1" data-to="2009" data-speed="1000"></span>
                                <span class="counter-number-text"></span>
                            </div>
                            <span class="counter-text">Founded</span>
                        </div>

                        <div class="counter-thumb">
                            <div class="d-flex">
                                <span class="counter-number-text">Rp. </span>
                                <span class="counter-number" data-from="1" data-to="120" data-speed="1000"></span>
                            </div>
                            <span class="counter-text">Donations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
