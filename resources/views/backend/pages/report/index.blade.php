@extends('backend.layouts.app')

@section('title', 'Laporan Penggalangan Dana ' . date_format_id($start) . ' s/d ' . date_format_id($end))
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Report</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <div class="btn-group">
                        <button data-toggle="modal" data-target="#modal-form" class="btn btn-primary"><i
                                class="fas fa-pencil-alt"></i> Ubah Periode</button>
                        <a target="_blank" href="{{ route('backend.report.export_pdf', compact('start', 'end')) }}"
                            class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</a>
                        <a target="_blank" href="{{ route('backend.report.export_excel', compact('start', 'end')) }}"
                            class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</a>
                    </div>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th width="25%" style="text-align: right;">Pemasukan</th>
                        <th width="25%" style="text-align: right;">Pengeluaran</th>
                        <th width="25%" style="text-align: right;">Sisa Kas</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @includeIf('backend.pages.report.form')
@endsection

<x-swal />

@includeIf('includes.datepicker')
@includeIf('includes.datatable')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('backend.report.data', compact('start', 'end')) }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tanggal',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'pemasukan',
                    searchable: false,
                    sortable: false,
                    className: 'text-right'
                },
                {
                    data: 'pengeluaran',
                    searchable: false,
                    sortable: false,
                    className: 'text-right'
                },
                {
                    data: 'sisa',
                    searchable: false,
                    sortable: false,
                    className: 'text-right'
                },
            ],
            paginate: false,
            searching: false,
            bInfo: false,
            order: []
        });
    </script>
@endpush
