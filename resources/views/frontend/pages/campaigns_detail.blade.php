@extends('frontend.layouts.app')

@section('content')
    <div class="program-single-section padding-tb padding-b aside-bg">
        <div class="container">
            <div class="section-wrapper">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-12">
                        <article>
                            <div class="pro-single-item mb-30 mb-lg-0">
                                <div class="pro-single-inner">
                                    <div class="pro-single-thumb">
                                        <img src="{{ asset('template/frontend/assets/images/program/program-single/01.png') }}"
                                            alt="Program-image">
                                    </div>
                                    <div class="bg-white pro-single-content">
                                        <!-- Program-progrss -->
                                        <div class="progress-item">
                                            <div class="progress-bar-wrapper progress" data-percent="50%">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated">
                                                </div>
                                            </div>
                                            <div
                                                class="progress-bar-percent d-flex align-items-center justify-content-center">
                                                50 <sup>%</sup> </div>
                                            <ul class="progress-item-status lab-ul d-flex justify-content-between">
                                                <li>
                                                    Terkumpul <span> Rp. {{ amount_format_id(500000) }}</span>
                                                </li>
                                                <li>
                                                    Dari <span> Rp. {{ amount_format_id(1000000) }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Donate Amount -->
                                        <div class="donate-amount">
                                            <div class="custom-donate">
                                                <span><span><i class="icofont-money-bag"></i></span></span>
                                                <input type="text" placeholder="$200">
                                            </div>

                                            <ul class="amount mb-30 lab-ul justify-content-center justify-content-lg-start">
                                                <li class="pay-price">$100.00</li>
                                                <li class="active pay-price">$250.00</li>
                                                <li class="pay-price">$500.00</li>
                                                <li class="pay-price">$1000.00</li>
                                                <li class="pay-price">Custom Amount</li>
                                            </ul>

                                            <div class="payment-mathod mb-30">
                                                <div class="flex-wrap d-flex align-items-center justify-content-between">
                                                    <div class="payment-left">
                                                        <h6>Select Payment Method :</h6>
                                                    </div>
                                                    <div class="payment-right">
                                                        <img src="assets/images/program/program-single/payment.jpg"
                                                            alt="payment mathod">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="personal-info mb-30">
                                                <h6 class="mb-4">Personal Info</h6>
                                                <form class="comment-form">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="First Name" name="fnme"
                                                            class="w-100">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Last Name" name="lname"
                                                            class="w-100">
                                                    </div>
                                                    <div class="form-group w-100">
                                                        <input type="email" placeholder="Your Email" name="email"
                                                            class="w-100">
                                                    </div>
                                                    <div
                                                        class="flex-wrap form-group d-flex align-items-center justify-content-between w-100">
                                                        <button type="submit" class="lab-btn"><span>Donate Now <i
                                                                    class="ml-2 fas fa-heart"></i></span></button>
                                                        <span class="total-donate"><b>Donation Total :</b>
                                                            $250.00</span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <p>
                                            Et ligula ullamcorper malesuada proin libero nunc. Quis vel eros donec ac
                                            odio
                                            temp ursus info hac habitasse platea and haselus egestas tellus rutrum
                                            tellus pellentesque eudiam
                                            phasellus vestibulum lorem sed risus ultrices tristique nulla uctor urna
                                            nuncen and cursus metus
                                            aliquam eleifend Sed turpis Diam volutpat commodo seding awsm in egestas
                                            egestas fringlla phasellus
                                            faucibus scelerisque egestas fringilla phasellus faucibus scelerisque.

                                        </p>
                                        <blockquote>
                                            <p>Quis veleros donec acodo tempor ursus nfohac habtase platea and haselu
                                                rutrum telus pellentesque eudiam phasellus vestibulum </p>
                                            <span>– OLIVER SANDERO</span>
                                        </blockquote>
                                        <p>
                                            Et ligula ullamcorper malesuada proin libero nunc. Quis vel eros donec ac
                                            odio
                                            temp ursus info hac habitasse platea and haselus egestas tellus rutrum
                                            tellus pellentesque eudiam
                                            phasellus vestibulum lorem sed risus ultrices tristique nulla uctor urna
                                            nuncen and cursus metus
                                            aliquam eleifend Sed turpis Diam volutpat commodo seding awsm in egestas
                                            egestas fringlla phasellus
                                            faucibus scelerisque egestas fringilla phasellus faucibus scelerisque.

                                        </p>
                                        <div class="flex-wrap con-thumb d-flex">
                                            <div class="left-part">
                                                <h6 class="mb-3">Challenge</h6>
                                                <p>
                                                    Quisvelng eros donec acng odio tempor ursus inf hact ligula
                                                    ulamcorper maesuada proin lberona nunc
                                                    habitasse platea and haselus egestas telus rutrum
                                                    tellus pellentesque eudiam phasellus vesti a
                                                    lorem sed risus ultrices tristque nulla uctor urna nunc and cursus
                                                    metus aliquam eleifend

                                                </p>
                                                <h6 class="mb-3">Summary</h6>
                                                <p>
                                                    Quisvelng eros donec acng odio tempor ursus inf hact ligula
                                                    ulamcorper maesuada proin lberona nunc
                                                    habitasse platea and haselus egestas telus rutrum
                                                    tellus pellentesque eudiam phasellus vesti a
                                                    lorem sed risus ultrices tristque nulla uctor urna nunc and cursus
                                                    metus aliquam eleifend

                                                </p>
                                            </div>
                                            <div class="right-part">
                                                <img src="assets/images/program/program-single/01.jpg" alt="Scholar-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="lab-inner d-flex align-items-center">
                            <div class="mb-3 lab-thumb">
                                <img src="{{ asset('template/frontend/assets/images/faith/01.png') }}" width="70"
                                    alt="faith-image">
                            </div>
                            <div class="mb-3 lab-thumb">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="lab-content">
                                <strong>Administrator</strong>
                                <p>Senin, 04 Juli 2023</p>
                            </div>
                        </div>
                        <div class="border-none card team-item-1" style="padding: 1em;">
                            <div class="lab-inner">
                                <div class="lab-content">
                                    <h6 class="text-center card-title">Donatur (3)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="border-none card team-item-1" style="padding: 1em;">
                            <div class="lab-inner">
                                <div class="lab-content">
                                    <h6 class="mb-3 text-center card-title">Waktu</h6>
                                    <div class="social-share">
                                        <ul>
                                            <li>
                                                <strong>User</strong><br>
                                                <strong>Rp. 10.000.000</strong><br>
                                                <span>Selasa, 01 Agustus 2023 22:10</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-none card team-item-1" style="padding: 1em;">
                            <div class="lab-inner">
                                <div class="lab-content">
                                    <h6 class="mb-3 text-center card-title">Jumlah</h6>
                                    <div class="social-share">
                                        <ul>
                                            <li>
                                                <strong>User</strong><br>
                                                <strong>Rp. 10.000.000</strong><br>
                                                <span>Selasa, 01 Agustus 2023 22:10</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
