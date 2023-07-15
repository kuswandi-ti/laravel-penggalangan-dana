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
                        <a href="{{ route('backend.campaign.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Program
                        </a>
                    </div>
                </x-slot>

                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="mr-3 form-group">
                            <label for="statuscampaign">Status Program</label>
                            <select class="custom-select" name="statuscampaign" id="statuscampaign" style="width: 100%;">
                                <option disabled selected>Pilih status...</option>
                                <option value="publish" {{ request('status') == 'publish' ? 'selected' : '' }}>Publish
                                </option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="archieve" {{ request('status') == 'archieve' ? 'selected' : '' }}>Diarsipkan
                                </option>
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
            ajax: {
                url: '{{ route('backend.campaign.data') }}',
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
