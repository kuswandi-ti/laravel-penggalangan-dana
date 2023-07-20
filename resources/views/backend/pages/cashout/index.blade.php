@extends('backend.layouts.app')

@section('title', 'Pencairan Dana')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Pencairan Dana</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Pencairan Dana</h3>
                    <div class="card-tools">
                        <button onclick="addForm(`{{ route('backend.cashout.store') }}`)" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Pencairan Dana
                        </button>
                    </div>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%" style="text-align: center;">No</th>
                        <th width="20%">Judul Projek</th>
                        @if (auth()->user()->hasRole('admin'))
                            <th style="text-align: center;">Donatur</th>
                        @endif
                        <th style="text-align: right;">Jumlah</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Tgl Cashout</th>
                        <th width="15%" style="text-align: center;"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @includeIf('backend.pages.cashout.form')
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
                url: '{{ route('backend.cashout.data', ['status' => request('status')]) }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'title'
                },
                @if (auth()->user()->hasRole('admin'))
                    {
                        data: 'name'
                    },
                @endif {
                    data: 'cashout_amount',
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
                    data: 'action',
                    searchable: false,
                    sortable: false
                },
            ],
            columnDefs: [{
                className: 'dt-center',
                targets: [0, 2, 4, 5, 6]
            }, {
                className: 'dt-right',
                targets: [3]
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
