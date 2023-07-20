@extends('backend.layouts.app')

@section('title', 'Program')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.campaign.index') }}">List Data Program</a></li>
    <li class="breadcrumb-item active">Detail Data Program</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3>{{ $campaign->title }}</h3>

                    <p class="mb-0 font-weight-bold">
                        Diposting oleh <span class="text-primary">{{ $campaign->user->name }}</span>
                        <small class="d-block">{{ date_format_id($campaign->publish_date) }}</small>
                    </p>
                    <p class="mb-0">
                        <span><small class="d-block">{{ $campaign->status }}</small></span>
                    </p>
                </x-slot>

                {!! $campaign->body !!}

                @if ($campaign->status == 'pending')
                    <x-slot name="footer">
                        <button class="btn btn-success"
                            onclick="editForm('{{ route('backend.campaign.update_status', $campaign->id) }}', 'publish', 'Yakin ingin mengkonfirmasi projek terpilih?', 'success')">Konfirmasi</button>
                    </x-slot>
                @elseif($campaign->status == 'publish')
                    <x-slot name="footer">
                        <button class="btn btn-danger"
                            onclick="editForm('{{ route('backend.campaign.update_status', $campaign->id) }}', 'archieve', 'Yakin ingin mengarsipkan projek terpilih?', 'danger')">Arsipkan</button>
                    </x-slot>
                @elseif ($campaign->status == 'archieve')
                    <x-slot name="footer">
                        <button class="btn btn-success"
                            onclick="editForm('{{ route('backend.campaign.update_status', $campaign->id) }}', 'publish', 'Yakin ingin membuka arsip projek terpilih?', 'success')">Buka
                            Arsip</button>
                    </x-slot>
                @endif
            </x-card>
        </div>
        <div class="col-lg-4">
            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Kategori</h5>
                </x-slot>
                <ul>
                    @foreach ($campaign->category_campaign as $item)
                        <li>{{ $item->name }}</li>
                    @endforeach
                </ul>
            </x-card>
            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Gambar Unggulan</h5>
                </x-slot>
                <img src="{{ url(env('PATH_IMAGE_STORAGE') . $campaign->path_image) }}" alt=""
                    class="img-thumbnail">
            </x-card>
            <x-card>
                <h3 class="font-weight-bold">Rp. {{ amount_format_id($campaign->amount) }}</h3>
                <p class="font-weight-bold">Terkumpul dari Rp. {{ amount_format_id($campaign->goal) }}</p>
                @php
                    $persen_tercapai = ($campaign->amount / $campaign->goal) * 100;
                @endphp
                <div class="progress" style="height: .3rem;">
                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $persen_tercapai }}"
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $persen_tercapai }}%">
                        <span class="sr-only">{{ $persen_tercapai }}% Complete (success)</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p>{{ amount_format_id($persen_tercapai) }}% terkumpul</p>
                    <p><strong>{{ now()->diff(new DateTime($campaign->end_date))->days }}</strong> hari lagi
                        ({{ now()->parse($campaign->end_date)->diffForHumans() }})</p>
                </div>
                <h4 class="font-weight-bold">Donatur (3)</h4>
                <div class="p-0 pt-1 mt-3 card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-time-tab" data-toggle="pill"
                                href="#custom-tabs-one-time" role="tab" aria-controls="custom-tabs-one-time"
                                aria-selected="true">Waktu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-amount-tab" data-toggle="pill"
                                href="#custom-tabs-one-amount" role="tab" aria-controls="custom-tabs-one-amount"
                                aria-selected="false">Jumlah</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-one-time" role="tabpanel"
                            aria-labelledby="custom-tabs-one-time-tab">
                            @forelse ($campaign->donations->where('status', 'paid')->sortBy('created_at')->load('user') as $key => $item)
                                <div @if ($key > 0) class="mt-1" @endif>
                                    <p class="mb-0 font-weight-bold">{{ $item->user->name }}</p>
                                    <p class="mb-0 font-weight-bold">Rp. {{ amount_format_id($item->nominal) }}</p>
                                    <p class="mb-0 text-muted">{{ date_format_id($item->created_at) }}</p>
                                </div>
                            @empty
                                <p class="mb-0 text-muted">Belum tersedia</p>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-amount" role="tabpanel"
                            aria-labelledby="custom-tabs-one-amount-tab">
                            @forelse ($campaign->donations->where('status', 'paid')->sortBy('nominal')->load('user') as $key => $item)
                                <div @if ($key > 0) class="mt-1" @endif>
                                    <p class="mb-0 font-weight-bold">{{ $item->user->name }}</p>
                                    <p class="mb-0 font-weight-bold">Rp. {{ amount_format_id($item->nominal) }}</p>
                                    <p class="mb-0 text-muted">{{ date_format_id($item->created_at) }}</p>
                                </div>
                            @empty
                                <p class="mb-0 text-muted">Belum tersedia</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>

    <x-form-modal size="modal-md">
        <x-slot name="title">
            Konfirmasi
        </x-slot>

        @method('put')

        <input type="hidden" name="status" value="publish">

        <div class="mt-3 alert">
            <i class="mr-1 fas fa-info-circle"></i> <span class="text-message"></span>
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
        </x-slot>
    </x-form-modal>
@endsection

<x-swal />

@push('scripts')
    <script>
        let modal = '#modal-form';

        function showAlert(message, type) {
            Toast.fire({
                icon: `${type}`,
                title: `${message}`,
            })
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

        function editForm(url, status, message, color) {
            $(modal).modal('show');
            $(`${modal} form`).attr('action', url);

            $(`${modal} [name=status]`).val(status);
            $(`${modal} .text-message`).text(message);
            $(`${modal} .alert`).removeClass('alert-success alert-danger').addClass(`alert-${color}`)
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
                    location.reload();
                    showAlert(response.message, 'success');
                })
                .fail(errors => {
                    if (errors.status == 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }

                    showAlert(errors.responseJSON.message, 'error');
                });
        }
    </script>
@endpush
