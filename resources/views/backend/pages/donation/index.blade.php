@extends('backend.layouts.app')

@section('title', 'Donasi')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Donasi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Donasi</h3>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%" style="text-align: center;">No</th>
                        <th width="20%">Judul Projek</th>
                        <th style="text-align: center;">Donatur</th>
                        <th style="text-align: right;">Jumlah</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Tgl Donasi</th>
                        <th style="text-align: center;">ID Transaksi</th>
                        <th width="15%" style="text-align: center;"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
@endsection

<x-swal />

@includeIf('includes.datatable')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('backend.donation.data', ['status' => request('status')]) }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'title'
                },
                {
                    data: 'name'
                },
                {
                    data: 'nominal',
                    searchable: false
                },
                {
                    data: 'status',
                    searchable: false
                },
                {
                    data: 'created_at',
                    searchable: false
                },
                {
                    data: 'order_number'
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ],
            columnDefs: [{
                className: 'dt-center',
                targets: [0, 2, 4, 5, 6, 7]
            }, {
                className: 'dt-right',
                targets: [3]
            }],
        });

        function showAlert(message, type) {
            Toast.fire({
                icon: `${type}`,
                title: `${message}`,
            })
        }

        function deleteData(url) {
            if (confirm('Yakin data akan dihapus?')) {
                $.post(url, {
                        '_method': 'delete'
                    })
                    .done(response => {
                        showAlert(response.message, 'success');
                        table.ajax.reload();
                    })
                    .fail(errors => {
                        showAlert(errors.message, "error");
                        return;
                    });
            }
        }
    </script>
@endpush
