@extends('backend.layouts.app')

@section('title', 'Program')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.campaign.index') }}">List Data Program</a></li>
    <li class="breadcrumb-item active">Pencairan Dana</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-7">
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

            @php
                $bank = $campaign->user->main_account();
            @endphp

            <x-card class="pre">
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
                        <p class="mb-0 font-weight-bold">Nama Pemilik Rekening :</p>
                        @if ($bank)
                            <input type="text" class="form-control-plaintext bank-ownername"
                                value="{{ $bank->pivot->account_name }}" readonly>
                        @endif
                    </div>
                    <div class="mt-3 col">
                        @if ($bank)
                            <button class="float-left btn btn-primary" data-toggle="modal"
                                data-target="#ganti-rekening">Ganti Rekening Tujuan</button>
                        @else
                            <button class="float-left btn btn-warning" data-toggle="modal"
                                data-target="#ganti-rekening">Silahkan Lengkapi Rekening Tujuan</button>
                        @endif
                    </div>
                </div>
            </x-card>
        </div>

        <div class="col-lg-5">
            <h3 class="text-primary">Yang Bisa Dicairkan: Rp.
                {{ amount_format_id($campaign->amount - $campaign->cashouts->whereIn('status', ['success', 'pending'])->sum('cashout_amount')) }}
            </h3>
            @if ($campaign->cashouts->whereIn('status', ['success', 'pending'])->sum('cashout_amount') > 0)
                @if ($campaign->cashout_latest->status == 'success')
                    <h5 class="d-block text-{{ $campaign->cashout_latest->status_color() }}">Sebelumnya Anda telah
                        mencairkan sebesar Rp. {{ amount_format_id($campaign->cashout_latest->cashout_amount) }}</h5>
                    <p>Terakhir dibuat pada {{ date_format_id($campaign->cashout_latest->created_at) }}
                        {{ date('H:i', strtotime($campaign->cashout_latest->created_at)) }}</p>
                @elseif ($campaign->cashout_latest->status == 'pending')
                    <h5 class="d-block text-{{ $campaign->cashout_latest->status_color() }}">Admin sedang meninjau
                        permintaan pengajuan pencairan Anda sebelumnya, sebesar Rp.
                        {{ amount_format_id($campaign->cashout_latest->cashout_amount) }}</h5>
                    <p>Terakhir dibuat pada {{ date_format_id($campaign->cashout_latest->created_at) }}
                        {{ date('H:i', strtotime($campaign->cashout_latest->created_at)) }}</p>
                @endif
            @endif
            <div class="alert alert-light border-primary">
                Disarankan untuk melakukan pencairan dana pada jam kerja normal (Senin-Jumat 08.00-20.00) untuk menghindari
                transaksi pending dikarenakan terkena cut off time dari bank yang bersangkutan.
            </div>

            <x-card>
                <form action="{{ route('backend.campaign.cashout.store', $campaign->id) }}" method="post"
                    class="form-pencairan" onsubmit="review_cashout()">
                    @csrf

                    <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                    <input type="hidden" name="user_id" value="{{ $campaign->user_id }}">
                    <input type="hidden" name="bank_id" value="{{ $bank->id ?? '' }}">
                    <input type="hidden" name="total"
                        value="{{ $campaign->amount - $campaign->cashouts->whereIn('status', ['success', 'pending'])->sum('cashout_amount') }}">

                    <div class="form-group">
                        <label for="cashout_amount">Jumlah Yang Ingin Dicairkan : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="text" class="form-control" name="cashout_amount" id="cashout_amount"
                                onkeyup="this">
                        </div>
                        <small class="text-danger text-message"></small>
                    </div>
                    <div class="form-group">
                        <label for="cashout_fee">Biaya :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="text" class="form-control" name="cashout_fee" id="cashout_fee"
                                value="{{ amount_format_id(5000) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount_received">Jumlah Yang Diterima :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="text" class="form-control" name="amount_received" id="amount_received"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remaining_amount">Sisa Dana :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                            </div>
                            <input type="text" class="form-control" name="remaining_amount" id="remaining_amount"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-success review-cashout" onclick="reviewCashout()"
                            disabled>Review Cashout</button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>

    <x-form-modal size="modal-md modal-dialog-centered">
        <x-slot name="title">
            Review Aktivitas Cashout
        </x-slot>

        @method('post')

        <table class="table table-sm table-borderless preview pre">
            <tr>
                <td>Nama Bank :</td>
                <td class="text-right nama-bank"></td>
            </tr>
            <tr>
                <td>Nomor Rekening :</td>
                <td class="text-right nomor-rekening"></td>
            </tr>
            <tr>
                <td>Pemilik Rekening :</td>
                <td class="text-right pemilik-rekening"></td>
            </tr>
            <tr>
                <td>Jumlah Yang Dicairkan :</td>
                <td class="text-right jumlah-dicairkan"></td>
            </tr>
            <tr>
                <td>Biaya :</td>
                <td class="text-right biaya"></td>
            </tr>
            <tr>
                <td>Jumlah Yang Diterima :</td>
                <td class="text-right jumlah-diterima"></td>
            </tr>
            <tr>
                <td>Sisa Saldo :</td>
                <td class="text-right sisa-saldo"></td>
            </tr>
        </table>

        <x-slot name="footer">
            <button type="button" class="btn btn-primary" onclick="submitForm()">Cashout!</button>
        </x-slot>
    </x-form-modal>

    <x-form-modal size="modal-md" id="ganti-rekening">
        <x-slot name="title">
            Ganti Rekening Tujuan
        </x-slot>

        <div class="mt-3 alert alert-info">
            <i class="mr-1 fas fa-info-circle"></i> Silahkan Update Rekening Di Menu Profil
        </div>

        <p class="mb-3">Silahkan Klik Link <a href="{{ route('backend.profile.show') }}?tab=bank">Berikut Ini</a>
            Untuk Update Rekening Tujuan</p>
    </x-form-modal>
@endsection

<x-swal />

@includeIf('includes.datatable')
@includeIf('includes.summernote')
@includeIf('includes.select2', ['placeholder' => 'Pilih Kategori'])
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let total,
            cashout_fee,
            cashout_amount,
            amount_received,
            remaining_amount,
            text_message,
            review_cashout;

        $(function() {
            total = parseFloat($('[name=total]').val().replaceAll('.', ''));
            cashout_fee = parseFloat($('[name=cashout_fee]').val().replaceAll('.', ''));
            cashout_amount = $('[name=cashout_amount]');
            amount_received = $('[name=amount_received]');
            remaining_amount = $('[name=remaining_amount]');
            text_message = $('.text-message');
            review_cashout = $('.review-cashout');

            cashout_amount.on('keyup', function() {
                let value = parseFloat(this.value == '' ? 0 : this.value.replaceAll('.', ''));

                if (value < 50000) {
                    text_message.text('Jumlah minimal adalah 50.000');
                    review_cashout.attr('disabled', true);
                    amount_received.val('0');
                    remaining_amount.val('0');
                } else if (value > total) {
                    text_message.text('Saldo tidak cukup');
                    review_cashout.attr('disabled', true);
                    amount_received.val('0');
                    remaining_amount.val('0');
                } else {
                    text_message.text('');
                    review_cashout.attr('disabled', false);
                    amount_received.val(value - cashout_fee);
                    remaining_amount.val(total - value);
                }
            });
        });

        function showAlert(message, type) {
            Toast.fire({
                icon: `${type}`,
                title: `${message}`,
            })
        }

        function resetForm(selector) {
            $(selector)[0].reset();
            $('.form-control, .custom-select, .custom-checkbox, .custom-radio, .select2, .custom-file-input, .custom-control-input, .note-editor')
                .removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }


        function reviewCashout() {
            $(modal).modal('show');

            $('.nama-bank').text($('.bank-name').val());
            $('.nomor-rekening').text($('.bank-account').val());
            $('.pemilik-rekening').text($('.bank-ownername').val());
            $('.jumlah-dicairkan').text(cashout_amount.val());
            $('.biaya').text(cashout_fee);
            $('.jumlah-diterima').text(amount_received.val());
            $('.sisa-saldo').text(remaining_amount.val());
        }

        function submitForm() {
            const originalForm = '.form-pencairan';
            $.post($(originalForm).attr('action'), $(originalForm).serialize())
                .done(response => {
                    $(modal).modal('hide');
                    showAlert(response.message, 'success');
                    resetForm(originalForm);

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                })
                .fail(errors => {
                    $(modal).modal('hide');

                    if (errors.status == 422) {
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }

                    showAlert(errors.responseJSON.message, 'error');
                });
        }
    </script>
@endpush
