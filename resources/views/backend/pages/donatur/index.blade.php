@extends('backend.layouts.app')

@section('title', 'Donatur')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Donatur</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Donatur</h3>
                    <div class="card-tools">
                        <button onclick="addForm(`{{ route('backend.donatur.store') }}`)" class="btn btn-primary"><i
                                class="fas fa-plus-circle"></i> Tambah Data Donatur</button>
                    </div>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No</th>
                        <th width="10%"></th>
                        <th>Nama</th>
                        <th>Tlp</th>
                        <th style="white-space: nowrap;" style="text-align: center;">Total Projek</th>
                        <th style="white-space: nowrap;" style="text-align: center;">Total Donasi</th>
                        <th style="white-space: nowrap;" style="text-align: center;">Tgl Gabung</th>
                        <th width="15%" style="text-align: center;"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @includeIf('backend.pages.donatur.form')
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
            ajax: {
                url: '{{ route('backend.donatur.data', ['email' => request('email')]) }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'path_image',
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
                    data: 'campaigns_count',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'donations_sum_nominal',
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
                targets: [0, 4, 5, 6, 7]
            }, {
                className: 'dt-right',
                targets: []
            }],
        });

        function resetForm(selector) {
            $(selector)[0].reset();
            $('.form-control, .custom-select, .custom-checkbox, .custom-radio, .select2, .custom-file-input, .custom-control-input, .note-editor')
                .removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }

        function loopForm(originalForm) {
            for (field in originalForm) {
                $(`[name=${field}]`).val(originalForm[field]);
            }
        }

        function loopErrors(errors) {
            $('.invalid-feedback').remove();
            $('.form-control, .custom-select, .custom-checkbox, .custom-radio, .select2, .custom-file-input, .custom-control-input, .note-editor')
                .removeClass('is-invalid');

            if (errors == undefined) {
                return;
            }

            for (error in errors) {
                $(`[name=${error}]`).addClass('is-invalid');

                if ($(`[name=${error}]`).hasClass('custom-control-input')) {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`));
                }
            }
        }

        function showAlert(message, type) {
            Toast.fire({
                icon: `${type}`,
                title: `${message}`,
            })
        }

        function addForm(url, title = 'Tambah Data Donatur') {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');

            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Edit Data Donatur') {
            $.get(url)
                .done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('PUT');

                    resetForm(`${modal} form`);
                    loopForm(response.data);
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function submitForm(originalForm) {
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    showAlert(response.message, 'success');
                    table.ajax.reload();
                })
                .fail(errors => {
                    if (errors.status == 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    showAlert(errors.responseJSON.message, 'error');
                });
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
