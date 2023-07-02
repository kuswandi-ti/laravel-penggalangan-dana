@extends('backend.layouts.app')

@section('title', 'Projek')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('campaign.index') }}">Projek</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3>{{ $campaign->title }}</h3>

                    <p class="mb-0 font-weight-bold">
                        Diposting oleh <span class="text-primary">{{ $campaign->user->name }}</span>
                        <small class="d-block">{{ date_format_id($campaign->publish_date) }}</small>
                    </p>
                </x-slot>

                {!! $campaign->body !!}
            </x-card>
        </div>
        <div class="col-lg-4">
            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Kategori</h5>
                </x-slot>
                <ul>
                    @foreach ($campaign->category_campaign as $item)
                        <li>{{ $item->name }}</li>
                    @endforeach
                </ul>
            </x-card>
            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Gambar Unggulan</h5>
                </x-slot>
                <img src="{{ Storage::disk('public')->url($campaign->path_image) }}" alt="" class="img-thumbnail">
            </x-card>
            <x-card>
                <h3 class="font-weight-bold">Rp. {{ amount_format_id(300000) }}</h3>
                <p class="font-weight-bold">Terkumpul dari Rp. {{ amount_format_id(10000000) }}</p>
                <div class="progress" style="height: .3rem;">
                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                        aria-valuemax="100" style="width: 40%">
                        <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p>40% terkumpul</p>
                    <p>3 bulan lagi</p>
                </div>
                <h4 class="font-weight-bold">Donatur (3)</h4>
                <div class="p-0 pt-1 mt-3 card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-time-tab" data-toggle="pill"
                                href="#custom-tabs-one-time" role="tab" aria-controls="custom-tabs-one-time"
                                aria-selected="true">Waktu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-amount-tab" data-toggle="pill"
                                href="#custom-tabs-one-amount" role="tab" aria-controls="custom-tabs-one-amount"
                                aria-selected="false">Jumlah</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-one-time" role="tabpanel"
                            aria-labelledby="custom-tabs-one-time-tab">
                            @for ($i = 0; $i < 5; $i++)
                                <div>
                                    <p class="mb-0 font-weight-bold">User</p>
                                    <p class="mb-0 font-weight-bold">Rp. {{ amount_format_id(10000000) }}</p>
                                    <p class="mb-3 text-muted">{{ date_format_id($campaign->publish_date) }}</p>
                                </div>
                            @endfor
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-amount" role="tabpanel"
                            aria-labelledby="custom-tabs-one-amount-tab">
                            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut
                            ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                            cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis
                            posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere
                            nec nunc. Nunc euismod pellentesque diam.
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
