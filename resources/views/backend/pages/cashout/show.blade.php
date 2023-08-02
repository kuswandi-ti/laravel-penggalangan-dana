@extends('backend.layouts.app')

@section('title', 'Detail Pencairan Dana')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Pencairan Dana</li>
    <li class="breadcrumb-item active">Detail Data Pencairan Dana</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3>{{ $campaign->title }}</h3>
                    <p class="mb-0 font-weight-bold">
                        Diposting oleh <span class="text-primary">{{ $campaign->user->name }}</span>
                        <small class="d-block">{{ date_format_id($campaign->publish_date) }}
                            {{ date('H:i', strtotime($campaign->publish_date)) }}</small>
                    </p>
                </x-slot>

                {!! $campaign->body !!}

                <x-slot name="footer">
                    <h1 class="font-weight-bold">Rp. {{ amount_format_id($campaign->amount) }}</h1>
                    <p class="font-weight-bold">Terkumpul dari Rp. {{ amount_format_id($campaign->goal) }}</p>
                    <div class="progress" style="height: .3rem;">
                        <div class="progress-bar" role="progressbar"
                            style="width: {{ ($campaign->amount / $campaign->goal) * 100 }}%"
                            aria-valuenow="{{ ($campaign->amount / $campaign->goal) * 100 }}" aria-valuemin="0"
                            aria-valuemax="{{ 100 }}"></div>
                    </div>
                    <div class="mt-1 d-flex justify-content-between">
                        <p>{{ ($campaign->amount / $campaign->goal) * 100 }}% tercapai</p>
                        @if (now()->parse($campaign->end_date)->lt(now()))
                            <p>selesai {{ now()->parse($campaign->end_date)->diffForHumans() }}</p>
                        @else
                            <p>tersisa {{ now()->parse($campaign->end_date)->diffForHumans() }}</p>
                        @endif
                    </div>
                </x-slot>
            </x-card>

            <div class="pre alert alert-light border-primary">
                <h3 class="mb-3">Rekening Bank Tujuan :</h3>
                <div class="row">
                    <div class="col-lg-4">
                        <p class="mb-0 font-weight-bold">Nama Bank :</p>
                        @if ($bank)
                            <input type="text" class="form-control-plaintext bank-name" value="{{ $bank->name }}"
                                readonly>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <p class="mb-0 font-weight-bold">Nomor Rekening :</p>
                        @if ($bank)
                            <input type="text" class="form-control-plaintext bank-account"
                                value="{{ $bank->pivot->account_number }}" readonly>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <p class="mb-0 font-weight-bold">Nama pemilik rekening:</p>
                        @if ($bank)
                            <input type="text" class="form-control-plaintext bank-ownername"
                                value="{{ $bank->pivot->account_name }}" readonly>
                        @endif
                    </div>
                </div>
            </div>

            <x-card class="card-confirm">
                <x-slot name="header">
                    <h5 class="mb-0">Dibuat pada {{ date_format_id($cashout->created_at) }}
                        {{ date('H:i', strtotime($cashout->created_at)) }}</h5>
                </x-slot>

                @if (auth()->user()->hasRole('admin'))
                    <div class="alert alert-light border-danger text-danger">
                        Silahkan transfer ke rekening diatas sesuai nominal berikut.
                    </div>
                    <h1 class="font-weight-bold text-danger">Rp. {{ amount_format_id($cashout->cashout_amount) }}</h1>
                @else
                    <div class="mb-0 alert alert-light border-danger text-danger">
                        Nominal yang ingin Anda cairkan adalah sebesar Rp. {{ amount_format_id($cashout->cashout_amount) }}
                    </div>
                @endif

                <x-slot name="footer">
                    @switch($cashout->status)
                        @case('pending')
                            @if ($cashout->user_id == auth()->id())
                                <button class="float-left btn btn-secondary"
                                    onclick="editForm('{{ route('backend.cashout.update', $cashout->id) }}', 'canceled', 'Yakin ingin membatalkan pencairan terpilih?', 'secondary')">Batalkan</button>
                            @endif

                            @if (auth()->user()->hasRole('admin'))
                                <button class="float-right ml-2 btn btn-success"
                                    onclick="editForm('{{ route('backend.cashout.update', $cashout->id) }}', 'success', 'Yakin ingin mengkonfirmasi pencairan terpilih?', 'success')">Konfirmasi</button>
                                <button class="float-right btn btn-danger"
                                    onclick="editForm('{{ route('backend.cashout.update', $cashout->id) }}', 'rejected', 'Yakin ingin menolak pencairan terpilih?', 'danger')">Tolak</button>
                            @endif
                        @break

                        @case('canceled')
                            <span class="text-{{ $cashout->status_color() }}">
                                {{ ucfirst($cashout->status_text()) }} oleh
                                @if (auth()->id() == $cashout->user_id)
                                    Anda
                                @else
                                    {{ $cashout->user->name }}
                                @endif
                            </span>
                        @break

                        @case('rejected')
                            <span class="text-{{ $cashout->status_color() }}">
                                {{ ucfirst($cashout->status_text()) }} oleh Admin karena {{ $cashout->reason_rejected }}
                            </span>
                        @break

                        @case('success')
                            <span class="text-{{ $cashout->status_color() }}">
                                Berhasil {{ ucfirst($cashout->status_text()) }} oleh Admin
                            </span>
                        @break

                        @default
                    @endswitch
                </x-slot>
            </x-card>
        </div>
    </div>

    <x-form-modal size="modal-md">
        <x-slot name="title">Form Konfirmasi</x-slot>

        @method('put')

        <input type="hidden" name="status">
        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

        <div class="mt-3 alert">
            <i class="mr-1 fas fa-info-circle"></i> <span class="text-message"></span>
        </div>

        <div class="form-group reason-rejected" style="display: none">
            <label for="reason_rejected">Alasan</label>
            <textarea name="reason_rejected" id="reason_rejected" rows="3" class="form-control"></textarea>
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Ya</button>
        </x-slot>
    </x-form-modal>
@endsection

<x-swal />

@includeIf('includes.datatable')

@push('scripts')
    <script>
        let modal = '#modal-form';

        function editForm(url, status, message, color) {
            $(modal).modal('show');
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('put');

            resetForm(`${modal} form`);

            $(`${modal} [name=status]`).val(status);
            $(`${modal} .text-message`).html(message);
            $(`${modal} .alert`).removeClass('alert-success alert-danger').addClass(`alert-${color}`);

            if (status == 'rejected') {
                $('.reason-rejected').show()
            } else {
                $('.reason-rejected').hide()
            }
        }

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

                    $('.card-footer').remove();
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
