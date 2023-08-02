@extends('backend.layouts.app')

@section('title', 'Berita')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Berita</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Berita</h3>
                    <div class="card-tools">
                        <a href="{{ route('backend.news.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Berita
                        </a>
                    </div>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%" style="text-align:center;">No</th>
                        <th width="10%"></th>
                        <th>Judul Berita</th>
                        <th>Konten Berita</th>
                        <th style="text-align:center;">Tgl Publish</th>
                        <th style="text-align:center;">Author</th>
                        <th width="15%" style="text-align:center;"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
@endsection

<x-swal />

@includeIf('includes.datatable')
@includeIf('includes.summernote')
@includeIf('includes.select2')
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('backend.news.data') }}',
            },
            columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                sortable: false,
            }, {
                data: 'path_image',
                searchable: false,
                sortable: false,
            }, {
                data: 'title',
                searchable: true,
            }, {
                data: 'body',
                searchable: true,
            }, {
                data: 'created_at',
                searchable: false,
            }, {
                data: 'author',
            }, {
                data: 'action',
                searchable: false,
                sortable: false,
            }],
            columnDefs: [{
                className: 'dt-center',
                targets: [0, 4, 5, 6]
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
