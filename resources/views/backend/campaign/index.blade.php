@extends('backend.layouts.app')

@section('title', 'Program')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Program</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Program</h3>
                    <div class="card-tools">
                        <button onclick="addForm(`{{ route('campaign.store') }}`)" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Program
                        </button>
                    </div>
                </x-slot>

                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="mr-3 form-group">
                            <label for="statuscampaign">Status Program</label>
                            <select class="custom-select" name="statuscampaign" id="statuscampaign" style="width: 100%;">
                                <option disabled selected>Pilih status...</option>
                                <option value="publish">Publish</option>
                                <option value="pending">Pending</option>
                                <option value="archieve">Diarsipkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="mx-3 form-group">
                            <label for="startdate">Tanggal Mulai</label>
                            <div class="input-group datepicker" id="startdate" data-target-input="nearest">
                                <input type="text" name="startdate" class="form-control datetimepicker-input"
                                    data-target="#startdate">
                                <div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="enddate">Tanggal Selesai</label>
                            <div class="input-group datepicker" id="enddate" data-target-input="nearest">
                                <input type="text" name="enddate" class="form-control datetimepicker-input"
                                    data-target="#enddate">
                                <div class="input-group-append" data-target="#enddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%" style="text-align:center;">No</th>
                        <th width="10%"></th>
                        <th>Deskripsi</th>
                        <th style="text-align:center;">Tgl Publish</th>
                        <th style="text-align:center;">Status</th>
                        <th style="text-align:center;">Author</th>
                        <th width="15%" style="text-align:center;"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @includeIf('backend.campaign.form')
@endsection

<x-swal />

@includeIf('includes.datatable')
@includeIf('includes.summernote')
@includeIf('includes.select2')
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        let form_modal_id = '#modal-form';
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('campaign.data') }}',
                data: function(d) {
                    d.statuscampaign = $('[name=statuscampaign]').val();
                    d.startdate = $('[name=startdate]').val();
                    d.enddate = $('[name=enddate]').val();
                }
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
                data: 'short_description',
            }, {
                data: 'publish_date',
                searchable: false,
            }, {
                data: 'status',
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
                targets: [4, 5, 6]
            }, ],
        });

        $('[name=statuscampaign]').on('change', function() {
            table.ajax.reload()
        })

        $('.datepicker').on('change.datetimepicker', function() {
            table.ajax.reload()
        })

        function resetForm(selector) {
            $(selector)[0].reset();
            $('.summernote').summernote('code', '')
            $('.select2').trigger('change');
            $('.form-control, .custom-select, .custom-checkbox, .custom-radio, .select2, .custom-file-input, .custom-control-input, .note-editor')
                .removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }

        function loopForm(originalForm) {
            for (field in originalForm) {
                if ($(`[name=${field}]`).attr('type') != 'file') {
                    if ($(`[name=${field}]`).hasClass('summernote')) {
                        $(`[name=${field}]`).summernote('code', originalForm[field]);
                    } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                        $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true)
                    } else {
                        $(`[name=${field}]`).val(originalForm[field]);
                    }

                    $('.select2').trigger('change');
                } else {
                    $(`.preview-${field}`)
                        .attr('src', `storage/${originalForm[field]}`)
                        .show()
                }
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

                if ($(`[name=${error}]`).hasClass('select2')) {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else if ($(`[name=${error}]`).hasClass('summernote')) {
                    $('.note-editor').addClass('is-invalid')
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                } else {
                    // Untuk pengecekan bertipe array pada input kategori
                    if ($(`[name=${error}]`).length == 0) {
                        $(`[name="${error}[]"]`).addClass('is-invalid');
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name="${error}[]"]`).next());
                    } else {
                        $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                            .insertAfter($(`[name=${error}]`));
                    }
                }
            }
        }

        function showAlert(message, type) {
            Toast.fire({
                icon: `${type}`,
                title: `${message}`,
            })
        }

        function addForm(url, title = 'Tambah Data Program') {
            $(form_modal_id).modal('show');
            $(`${form_modal_id} .modal-title`).text(title);
            $(`${form_modal_id} form`).attr('action', url);
            resetForm(`${form_modal_id} form`);
        }

        function editForm(url, title = 'Edit Data Program') {
            $.get(url)
                .done(response => {
                    $(form_modal_id).modal('show');
                    $(`${form_modal_id} .modal-title`).text(title);
                    $(`${form_modal_id} form`).attr('action', url);
                    $(`${form_modal_id} [name=_method]`).val('PUT');

                    resetForm(`${form_modal_id} form`);
                    loopForm(response.data);

                    let selectedCategories = []
                    response.data.categories.forEach(item => {
                        selectedCategories.push(item.id)
                    });
                    $('#categories')
                        .val(selectedCategories)
                        .trigger('change')
                })
                .fail(errors => {
                    showAlert(errors.response.message, 'error');
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
                    processData: false,
                })
                .done(response => {
                    $(form_modal_id).modal('hide');
                    showAlert(response.message, 'success');
                    table.ajax.reload();
                })
                .fail(errors => {
                    if (errors.status = 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                    showAlert(errors.responseJSON.message, 'error');
                });
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
