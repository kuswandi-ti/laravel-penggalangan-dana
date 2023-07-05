@extends('frontend.layouts.app')

@section('title', 'Kontak')

@section('content')
    <div class="contact-section">
        <div class="contact-top padding-tb aside-bg padding-b">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <article class="contact-form-wrapper">
                            <div class="contact-form">
                                <h4>Don't Be A Stranger Just Say Hello.</h4>
                                <p class="mb-5">We do fast phone repair. In most to repair your device in just minutes,
                                    li we’ll
                                    normally get con nection inutes, we’ll normally ge.</p>
                                <form action="#" method="POST" id="commentform" class="comment-form">
                                    <input type="text" name="name" class="" placeholder="Name*">
                                    <input type="email" name="email" class="" placeholder="Email*">
                                    <input type="text" name="name" class="" placeholder="Name*">
                                    <input type="email" name="email" class="" placeholder="Email*">
                                    <textarea name="text" id="role" cols="30" rows="9" placeholder="Message*"></textarea>
                                    <button type="submit" class="lab-btn">
                                        <span>Send Our Message</span>
                                    </button>
                                </form>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-info-wrapper">
                            <div class="contact-info-title">
                                <h5>Get Information</h5>
                                <p>Our Contact information Details and
                                    Follow us on social media</p>
                            </div>
                            <div class="contact-info-content">
                                <div class="contact-info-item">
                                    <div class="contact-info-inner">
                                        <div class="contact-info-thumb">
                                            <img src="{{ asset('template/frontend/assets/images/contact/01.png') }}"
                                                alt="address">
                                        </div>
                                        <div class="contact-info-details">
                                            <span class="fw-bold">Office Address</span>
                                            <p>1201 park street, Fifth Avenue</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <div class="contact-info-inner">
                                        <div class="contact-info-thumb">
                                            <img src="{{ asset('template/frontend/assets/images/contact/02.png') }}"
                                                alt="address">
                                        </div>
                                        <div class="contact-info-details">
                                            <span class="fw-bold">Phone Number</span>
                                            <p>+22698 745 632,02 982 745</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <div class="contact-info-inner">
                                        <div class="contact-info-thumb">
                                            <img src="{{ asset('template/frontend/assets/images/contact/03.png') }}"
                                                alt="address">
                                        </div>
                                        <div class="contact-info-details">
                                            <span class="fw-bold">Send Mail</span>
                                            <p>adminHafsa@gmil.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <div class="contact-info-inner">
                                        <div class="contact-info-thumb">
                                            <img src="{{ asset('template/frontend/assets/images/contact/04.png') }}"
                                                alt="address">
                                        </div>
                                        <div class="contact-info-details">
                                            <span class="fw-bold">Our Website</span>
                                            <p>www.Hafsa-charity.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-bottom">
            <div class="contac-bottom">
                <div class="row justify-content-center g-0">
                    <div class="col-12">
                        <div class="location-map">
                            <div id="map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.227736753981!2d90.38698831452395!3d23.739256984594892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b85c740f17d1%3A0xdd3daab8c90eb11f!2sCodexCoder!5e0!3m2!1sbn!2sbd!4v1610134370994!5m2!1sbn!2sbd"
                                    allowfullscreen="">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
