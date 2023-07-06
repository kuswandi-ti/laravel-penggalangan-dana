@extends('frontend.layouts.app')

@section('title', 'Galang Dana')

@push('style_vendor')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
@endpush

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="p-4 mb-5 bg-white shadow-sm">
                        <div id="stepper1" class="bs-stepper linear">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step active" data-target="#test-l-1">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger1"
                                        aria-controls="test-l-1" aria-selected="true">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Email</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-2">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger2"
                                        aria-controls="test-l-2" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Password</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-3">
                                    <button type="button" class="step-trigger" role="tab" id="stepper1trigger3"
                                        aria-controls="test-l-3" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Validate</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <form onsubmit="return false">
                                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane active dstepper-block"
                                        aria-labelledby="stepper1trigger1">
                                        @includeIf('frontend.pages.campaign.step.judul')
                                    </div>
                                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane"
                                        aria-labelledby="stepper1trigger2">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                        <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                                    </div>
                                    <div id="test-l-3" role="tabpanel" class="text-center bs-stepper-pane"
                                        aria-labelledby="stepper1trigger3">
                                        <button class="mt-5 btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                        <button type="submit" class="mt-5 btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_vendor')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            window.stepper = new Stepper($('.bs-stepper')[0])
        })

        var stepper1
        var stepper2
        var stepper3
        var stepper4
        var stepperForm

        document.addEventListener('DOMContentLoaded', function() {
            stepper1 = new Stepper(document.querySelector('#stepper1'))
            stepper2 = new Stepper(document.querySelector('#stepper2'), {
                linear: false
            })
            stepper3 = new Stepper(document.querySelector('#stepper3'), {
                linear: false,
                animation: true
            })
            stepper4 = new Stepper(document.querySelector('#stepper4'))

            var stepperFormEl = document.querySelector('#stepperForm')
            stepperForm = new Stepper(stepperFormEl, {
                animation: true
            })

            var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
            var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
            var inputMailForm = document.getElementById('inputMailForm')
            var inputPasswordForm = document.getElementById('inputPasswordForm')
            var form = stepperFormEl.querySelector('.bs-stepper-content form')

            btnNextList.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    stepperForm.next()
                })
            })

            stepperFormEl.addEventListener('show.bs-stepper', function(event) {
                form.classList.remove('was-validated')
                var nextStep = event.detail.indexStep
                var currentStep = nextStep

                if (currentStep > 0) {
                    currentStep--
                }

                var stepperPan = stepperPanList[currentStep]

                if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length) ||
                    (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
                    event.preventDefault()
                    form.classList.add('was-validated')
                }
            })
        })
    </script>
@endpush
