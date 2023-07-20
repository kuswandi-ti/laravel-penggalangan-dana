@extends('backend.layouts.app')

@section('title', 'Kontak Masuk')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Kontak Masuk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Kontak Masuk</h3>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%" style="text-align:center;">No</th>
                        <th>Nama</th>
                        <th style="text-align:center;">Tlp</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th style="text-align:center;">Tgl Kirim</th>
                        <th width="15%" style="text-align:center;"><i class="fas fa-cog"></i></th>
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
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('backend.contact.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'phone',
                    searchable: false
                },
                {
                    data: 'subject'
                },
                {
                    data: 'message',
                    searchable: false
                },
                {
                    data: 'created_at',
                    searchable: false
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ],
            columnDefs: [{
                className: 'dt-center',
                targets: [0, 2, 5, 6]
            }, ],
        });

        function showAlert(message, type) {
            Toast.fire({
                icon: `${type}`,
                title: `${message}`,
            })
        }

        function deleteData(url) {
            if (confirm('Yakin akan menghapus data ?')) {
                $.post(url, {
                        '_method': 'delete'
                    })
                    .done(response => {
                        showAlert(response.message, 'success');
                        table.ajax.reload();
                    })
                    .fail(errors => {
                        showAlert(errors.responseJSON.message, 'error');
                        return;
                    });
            }
        }
    </script>
@endpush
