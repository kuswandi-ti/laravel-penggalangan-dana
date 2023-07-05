@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero-section hero-section-full-height">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12 p-0">
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
                <div class="col-lg-10 col-12 text-center mx-auto">
                    <h2 class="mb-5">Welcome to Kind Heart Charity</h2>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/hands.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Penerimaan <br><strong>Relawan</strong></p>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/heart.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Kegiatan <br><strong>Keagamaan</strong></p>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                    <div class="featured-block d-flex justify-content-center align-items-center">
                        <a class="d-block">
                            <img src="{{ asset('template/frontend/images/icons/receive.png') }}"
                                class="featured-block-image img-fluid" alt="">
                            <p class="featured-block-text">Penerimaan <br><strong>Donasi</strong></p>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
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

    <section class="section-padding section-bg" id="section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mb-5 mb-lg-0">
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

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="custom-text-box d-flex flex-wrap d-lg-block mb-lg-0">
                                <div class="counter-thumb">
                                    <div class="d-flex">
                                        <span class="counter-number" data-from="1" data-to="2009" data-speed="1000"></span>
                                        <span class="counter-number-text"></span>
                                    </div>
                                    <span class="counter-text">Founded</span>
                                </div>

                                <div class="counter-thumb mt-4">
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

    <section class="section-padding" id="section_3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center mb-4">
                    <h2>Our Causes</h2>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                    <div class="custom-block-wrap">
                        <img src="{{ asset('template/frontend/images/causes/group-african-kids-paying-attention-class.jpg') }}"
                            class="custom-block-image img-fluid" alt="">
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">Children Education</h5>
                                <p>Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm tokito</p>
                                <div class="progress mt-4">
                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <p class="mb-0">
                                        <strong>Raised:</strong>
                                        $18,500
                                    </p>
                                    <p class="ms-auto mb-0">
                                        <strong>Goal:</strong>
                                        $32,000
                                    </p>
                                </div>
                            </div>
                            <a href="donate.html" class="custom-btn btn">Donate now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                    <div class="custom-block-wrap">
                        <img src="{{ asset('template/frontend/images/causes/poor-child-landfill-looks-forward-with-hope.jpg') }}"
                            class="custom-block-image img-fluid" alt="">
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">Poverty Development</h5>
                                <p>Sed leo nisl, posuere at molestie ac, suscipit auctor mauris. Etiam quis metus
                                    tempor</p>
                                <div class="progress mt-4">
                                    <div class="progress-bar w-50" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <p class="mb-0">
                                        <strong>Raised:</strong>
                                        $27,600
                                    </p>
                                    <p class="ms-auto mb-0">
                                        <strong>Goal:</strong>
                                        $60,000
                                    </p>
                                </div>
                            </div>
                            <a href="donate.html" class="custom-btn btn">Donate now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="custom-block-wrap">
                        <img src="{{ asset('template/frontend/images/causes/african-woman-pouring-water-recipient-outdoors.jpg') }}"
                            class="custom-block-image img-fluid" alt="">
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">Supply drinking water</h5>
                                <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                                </p>
                                <div class="progress mt-4">
                                    <div class="progress-bar w-100" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <p class="mb-0">
                                        <strong>Raised:</strong>
                                        $84,600
                                    </p>
                                    <p class="ms-auto mb-0">
                                        <strong>Goal:</strong>
                                        $100,000
                                    </p>
                                </div>
                            </div>
                            <a href="donate.html" class="custom-btn btn">Donate now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section section-padding" id="section_4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 ms-auto mb-5 mb-lg-0">
                    <div class="contact-info-wrap">
                        <h2>Get in touch</h2>
                        <div class="contact-image-wrap d-flex flex-wrap">
                            <img src="{{ asset('template/frontend/images/avatar/pretty-blonde-woman-wearing-white-t-shirt.jpg') }}"
                                class="img-fluid avatar-image" alt="">
                            <div class="d-flex flex-column justify-content-center ms-3">
                                <p class="mb-0">Clara Barton</p>
                                <p class="mb-0"><strong>HR & Office Manager</strong></p>
                            </div>
                        </div>
                        <div class="contact-info">
                            <h5 class="mb-3">Contact Infomation</h5>
                            <p class="d-flex mb-2">
                                <i class="bi-geo-alt me-2"></i>
                                Akershusstranda 20, 0150 Oslo, Norway
                            </p>
                            <p class="d-flex mb-2">
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
                            <a href="#" class="custom-btn btn mt-3">Get Direction</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mx-auto">
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
                        <button type="submit" class="form-control">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
