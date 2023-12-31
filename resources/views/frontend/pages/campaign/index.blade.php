@extends('frontend.layouts.app')

@section('title', 'Galang Dana')

@push('styles_vendor')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
@endpush

@section('content')
    <section class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="p-4 mb-5 bg-white shadow-sm">
                        <div class="bs-stepper linear">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step active" data-target="#detail-part">
                                    <button type="button" class="step-trigger" role="tab" id="detail-part-trigger"
                                        aria-controls="detail-part" aria-selected="true">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Detail</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#foto-part">
                                    <button type="button" class="step-trigger" role="tab" id="foto-part-trigger"
                                        aria-controls="foto-part" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Foto</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#konfirmasi-part">
                                    <button type="button" class="step-trigger" role="tab" id="konfirmasi-part-trigger"
                                        aria-controls="konfirmasi-part" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Konfirmasi</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                @if (Route::is('frontend.campaigns.index'))
                                    <form action="{{ route('backend.campaign.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                    @else
                                        <form action="{{ route('backend.campaign.update', $campaign->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                @endif
                                <x-alert-message />
                                <div id="detail-part" role="tabpanel" class="bs-stepper-pane active dstepper-block"
                                    aria-labelledby="detail-part-trigger">
                                    @if (Route::is('frontend.campaigns.index'))
                                        @includeIf('frontend.pages.campaign.step.detail')
                                    @else
                                        @includeIf('frontend.pages.campaign.step-edit.detail')
                                    @endif
                                </div>
                                <div id="foto-part" role="tabpanel" class="bs-stepper-pane"
                                    aria-labelledby="foto-part-trigger">
                                    @if (Route::is('frontend.campaigns.index'))
                                        @includeIf('frontend.pages.campaign.step.foto')
                                    @else
                                        @includeIf('frontend.pages.campaign.step-edit.foto')
                                    @endif
                                </div>
                                <div id="konfirmasi-part" role="tabpanel" class="bs-stepper-pane"
                                    aria-labelledby="konfirmasi-part-trigger">
                                    @if (Route::is('frontend.campaigns.index'))
                                        @includeIf('frontend.pages.campaign.step.konfirmasi')
                                    @else
                                        @includeIf('frontend.pages.campaign.step-edit.konfirmasi')
                                    @endif
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
    <script src="{{ asset('public/template/backend/plugins/moment/moment.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
@endpush

@includeIf('includes.summernote')
@includeIf('includes.select2', ['placeholder' => 'Pilih Kategori'])
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        $(document).ready(function() {
            window.stepper = new Stepper($('.bs-stepper')[0])
        })
    </script>
@endpush
