@extends('backend.layouts.app')

@section('title', 'Dashboard (Admin)')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard (Admin)</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlah_kategori ?? 0 }}</h3>
                    <p>Jumlah Kategori</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cube"></i>
                </div>
                <a href="{{ route('category.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlah_program_all ?? 0 }}</h3>
                    <p>Jumlah Semua Program</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <a href="{{ route('campaign.index', ['status' => 'pending']) }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlah_program_pending ?? 0 }}</h3>
                    <p>Jumlah Program Pending</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <a href="{{ route('campaign.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlah_kontak_masuk ?? 0 }}</h3>
                    <p>Kontak Masuk Baru</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_donasi ?? 0 }}</h3>
                    <p>Total Donasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-donate"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('template/dist/js/demo.js') }}"></script>
    <script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>
@endpush
