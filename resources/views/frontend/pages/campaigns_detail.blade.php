@extends('frontend.layouts.app')

@section('title', 'Judul Program')

@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="custom-block-wrap">
                        <img src="{{ asset('template/frontend/images/causes/group-african-kids-paying-attention-class.jpg') }}"
                            class="custom-block-image img-fluid" alt="">
                        <div class="custom-block">
                            <div class="custom-block-body">
                                <h5 class="mb-3">Children Education</h5>
                                <p>Lorem Ipsum dolor sit amet, consectetur adipsicing kengan omeg kohm tokito</p>
                                <div class="progress mt-4">
                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100"></div>
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
            </div>
        </div>
    </section>
@endsection
