@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero-section hero-section-full-height">
        <div class="container-fluid">
            <div class="row">
                <div class="p-0 col-lg-12 col-12">
                    <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('template/frontend/images/slide/volunteer-helping-with-donation-box.jpg') }}"
                                    class="carousel-image img-fluid" alt="...">
                                <div class="carousel-caption d-flex flex-column justify-content-end">
                                    <h1>be a Kind Heart</h1>
                                    <p>Professional charity theme based on Bootstrap 5.2.2</p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('template/frontend/images/slide/volunteer-selecting-organizing-clothes-donations-charity.jpg') }}"
                                    class="carousel-image img-fluid" alt="...">
                                <div class="carousel-caption d-flex flex-column justify-content-end">
                                    <h1>Non-profit</h1>
                                    <p>You can support us to grow more</p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('template/frontend/images/slide/medium-shot-people-collecting-donations.jpg') }}"
                                    class="carousel-image img-fluid" alt="...">
                                <div class="carousel-caption d-flex flex-column justify-content-end">
                                    <h1>Humanity</h1>
                                    <p>Please tell your friends about our website</p>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#hero-slide"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="mx-auto text-center col-lg-10 col-12">
                    <h2 class="mb-5">Welcome to Kind Heart Charity</h2>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/hands.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Penerimaan <br><strong>Relawan</strong></p>
                        </a>
                    </div>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0 mb-md-4">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/heart.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Kegiatan <br><strong>Keagamaan</strong></p>
                        </a>
                    </div>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0 mb-md-4">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/receive.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Penerimaan <br><strong>Donasi</strong></p>
                        </a>
                    </div>
                </div>

                <div class="mb-4 col-lg-3 col-md-6 col-12 mb-lg-0">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/scholarship.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Pondok <br><strong>Pesantren</strong></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mb-3 col-lg-6 col-12 mb-lg-0">
                    <img src="{{ asset('template/frontend/images/group-people-volunteering-foodbank-poor-people.jpg') }}"
                        class="custom-text-box-image img-fluid" alt="">
                </div>

                <div class="col-lg-6 col-12">
                    <div class="custom-text-box">
                        <h2 class="mb-2">Our Story</h2>
                        <h5 class="mb-3">Kind Heart Charity, Non-Profit Organization</h5>
                        <p class="mb-0">This is a Bootstrap 5.2.2 CSS template for charity organization websites.
                            You can feel free to use it. Please tell your friends about TemplateMo website. Thank
                            you. HTML CSS files updated on 20 Oct 2022.</p>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="custom-text-box mb-lg-0">
                                <h5 class="mb-3">Our Mission</h5>
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
                                        <span class="counter-number" data-from="1" data-to="120"
                                            data-speed="1000"></span>
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

    @includeIf('frontend.pages.donation.page')

    <section class="contact-section section-padding" id="section_4">
        <div class="container">
            <div class="row">
                <div class="mb-5 col-lg-6 col-12 ms-auto mb-lg-0">
                    <div class="contact-info-wrap">
                        <h2>Get in touch</h2>
                        <div class="flex-wrap contact-image-wrap d-flex">
                            <img src="{{ asset('template/frontend/images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg') }}"
                                class="img-fluid avatar-image" alt="">
                            <div class="d-flex flex-column justify-content-center ms-3">
                                <p class="mb-0">Clara Barton</p>
                                <p class="mb-0"><strong>HR & Office Manager</strong></p>
                            </div>
                        </div>
                        <div class="contact-info">
                            <h5 class="mb-3">Contact Infomation</h5>
                            <p class="mb-2 d-flex">
                                <i class="bi-geo-alt me-2"></i>
                                Akershusstranda 20, 0150 Oslo, Norway
                            </p>
                            <p class="mb-2 d-flex">
                                <i class="bi-telephone me-2"></i>

                                <a href="tel: 120-240-9600">
                                    120-240-9600
                                </a>
                            </p>
                            <p class="d-flex">
                                <i class="bi-envelope me-2"></i>
                                <a href="mailto:info@yourgmail.com">
                                    donate@charity.org
                                </a>
                            </p>
                            <a href="#" class="mt-3 custom-btn btn">Get Direction</a>
                        </div>
                    </div>
                </div>
                <div class="mx-auto col-lg-6 col-12">
                    <form class="custom-form contact-form" action="#" method="post" role="form">
                        <h2>Contact form</h2>
                        <p class="mb-4">Or, you can just send an email:
                            <a href="#">info@charity.org</a>
                        </p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <input type="text" name="first-name" id="first-name" class="form-control"
                                    placeholder="Jack" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <input type="text" name="last-name" id="last-name" class="form-control"
                                    placeholder="Doe" required>
                            </div>
                        </div>
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
                            class="form-control" placeholder="Jackdoe@gmail.com" required>
                        <textarea name="message" rows="5" class="form-control" id="message" placeholder="What can we help you?"></textarea>
                        <button type="button" class="btn btn-block custom-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
