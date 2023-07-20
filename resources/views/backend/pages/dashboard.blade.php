@extends('backend.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('public/template/backend/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

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
                <a href="{{ route('backend.category.index') }}" class="small-box-footer">
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
                <a href="{{ route('backend.campaign.index') }}" class="small-box-footer">
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
                <a href="{{ route('backend.campaign.index', ['status' => 'pending']) }}" class="small-box-footer">
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
                    <h3>{{ amount_format_id($total_donasi ?? 0) }}</h3>
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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlah_donasi_belum_dibayar ?? 0 }}</h3>
                    <p>Jumlah Donasi Belum Dibayar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <a href="{{ route('backend.donation.index', ['status' => 'not paid']) }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlah_donasi_sudah_dibayar ?? 0 }}</h3>
                    <p>Jumlah Donasi Sudah Dibayar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <a href="{{ route('backend.donation.index', ['status' => 'paid']) }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ amount_format_id($total_donasi_dicairkan ?? 0) }}</h3>
                    <p>Total Donasi Dicairkan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <a href="{{ route('backend.cashout.index', ['status' => 'success']) }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Laporan donasi dan pencairan {{ date('Y') }}
                    </h3>
                </div>
                <div class="card-body text-center pb-0">
                    {{ date_format_id(date('Y-01-01')) }} s/d {{ date_format_id(date('Y-12-31')) }}
                </div>
                <div class="card-body pt-0">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
            </div>
        </section>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">10 projek populer bulan ini</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Judul</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Jumlah Donasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projek_populer as $key => $item)
                                    <tr>
                                        <td><a
                                                href="{{ route('backend.campaign.show', $item->id) }}">{{ $key + 1 }}</a>
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td style="text-align: center;"><span
                                                class="badge badge-{{ $item->status_color() }}">{{ $item->status }}</span>
                                        </td>
                                        <td style="text-align: center;">{{ $item->donations_count }}x</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Top 10 donatur bulan ini</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nama</th>
                                    <th style="text-align: center;">Jumlah Donasi</th>
                                    <th style="text-align: center;">Jumlah Projek</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($top_donatur as $key => $item)
                                    <tr>
                                        <td><a
                                                href="{{ route('backend.donatur.index', ['email' => $item->email]) }}">{{ $key + 1 }}</a>
                                        </td>
                                        <td>
                                            {{ $item->name }}
                                            <br>
                                            <a href="mailto:{{ $item->email }}" target="_blank">{{ $item->email }}</a>
                                        </td>
                                        <td style="text-align: center;">{{ $item->donations_count }}x</td>
                                        <td style="text-align: center;">{{ $item->campaigns_count }}x</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <section class="col-lg-5 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Pengguna bulan ini
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="sales-chart-canvas" height="150" style="height: 150px;"></canvas>
                        </div>
                        <div class="col-md-6">
                            <ul class="chart-legend clearfix">
                                <li><i class="far fa-circle text-danger"></i> Donatur</li>
                                <li><i class="far fa-circle text-success"></i> Subscriber</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notifikasi terbaru <span
                            class="badge badge-danger">{{ $count_notifikasi }}</span></h3>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($list_notifikasi as $key => $notifikasi)
                            @foreach ($notifikasi as $item)
                                <li class="item">
                                    <div class="product-info ml-1">
                                        <a href="{{ route("backend.$key.index") }}" class="product-title">
                                            {{ $item->name ?? ($item->email ?? ($item->user->name ?? '')) }}
                                            <span
                                                class="badge
                                @switch($key)
                                    @case('donatur') badge-warning @break
                                    @case('subscriber') badge-secondary @break
                                    @case('contact') badge-info @break
                                    @case('donation') badge-primary @break
                                    @case('cashout') badge-success @break
                                @endswitch
                                float-right">{{ $key }}
                                                baru</span>
                                        </a>
                                        <span class="product-description">
                                            {{ now()->parse($item->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts_vendor')
    <script src="{{ asset('public/template/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endpush

@push('scripts')
    {{-- <script src="{{ asset('public/template/backend/dist/js/demo.js') }}"></script>
    <script src="{{ asset('public/template/backend/dist/js/pages/dashboard.js') }}"></script> --}}
    <script>
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
        var salesChartData = {
            labels: @json($list_bulan),
            datasets: [{
                    label: 'Donasi',
                    backgroundColor: 'rgba(10, 123,255, .9)',
                    borderColor: 'rgba(10, 123, 255, .8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(10, 123, 255, 1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(10, 123, 255, 1)',
                    data: @json($list_donasi)
                },
                {
                    label: 'Pencairan',
                    backgroundColor: 'rgba(210, 214, 222, .9)',
                    borderColor: 'rgba(210, 214, 222, .8)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: @json($list_pencairan)
                }
            ]
        }
        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })

        // Donut Chart
        var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var pieData = {
            labels: @json($list_nama_user),
            datasets: [{
                data: @json($list_jumlah_user),
                backgroundColor: ['#f56954', '#00a65a']
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            responsive: true
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })
    </script>
@endpush
