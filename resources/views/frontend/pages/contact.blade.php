@extends('frontend.layouts.app')

@section('title', 'Kontak')

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="mb-5 col-lg-6 col-12">
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
                <div class="col-lg-6 col-12">
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
                                <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Doe"
                                    required>
                            </div>
                        </div>
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"
                            placeholder="Jackdoe@gmail.com" required>
                        <textarea name="message" rows="5" class="form-control" id="message" placeholder="What can we help you?"></textarea>
                        <button type="button" class="btn btn-block custom-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
