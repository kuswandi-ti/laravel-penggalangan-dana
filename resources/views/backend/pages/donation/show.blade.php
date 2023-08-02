@extends('backend.layouts.app')

@section('title', 'Donasi')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.donation.index') }}">List Data Donasi</a></li>
    <li class="breadcrumb-item active">Detail Data Donasi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <x-card>
                <x-slot name="header">
                    <h3>{{ $donation->campaign->title }}</h3>
                    <p class="mb-0 font-weight-bold">
                        Diposting oleh <span class="text-primary">{{ $donation->campaign->user->name }}</span>
                        <small class="d-block">{{ date_format_id($donation->campaign->publish_date) }}
                            {{ date('H:i', strtotime($donation->campaign->publish_date)) }}</small>
                    </p>
                </x-slot>

                {!! $donation->campaign->short_description !!}

                <br>
                <strong class="mt-3 mb-2 d-block">Donatur</strong>
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <td width="35%">ID Transaksi</td>
                            <td>: {{ $donation->order_number }}</td>
                        </tr>
                        <tr>
                            <td width="35%">Donatur</td>
                            <td>: {{ $donation->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>: {{ amount_format_id($donation->nominal) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Donasi</td>
                            <td>: {{ date_format_id($donation->created_at) }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>: <span
                                    class="badge badge-{{ $donation->status_color() }}">{{ $donation->status_text() }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <strong class="mt-3 mb-2 d-block">Pembayaran</strong>
                @if ($donation->payment)
                    <table class="table table-sm table-bordered">
                        <tbody>
                            <tr>
                                <td width="35%">Pengirim</td>
                                <td>: {{ $donation->payment->name }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>: {{ amount_format_id($donation->payment->nominal) }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Transfer</td>
                                <td>: {{ date_format_id($donation->payment->created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    Belum tersedia
                @endif

                @if ($donation->status == 'not paid')
                    <x-slot name="footer">
                        @if ($donation->user_id == auth()->id())
                            <button class="float-left btn btn-danger"
                                onclick="editForm('{{ route('backend.donation.update', $donation->id) }}', 'cancel', 'Yakin ingin membatalkan pembayaran donasi terpilih?', 'danger')">Batalkan</button>
                        @endif

                        @if (auth()->user()->hasRole('admin'))
                            <button class="float-right btn btn-success"
                                onclick="editForm('{{ route('backend.donation.update', $donation->id) }}', 'paid', 'Yakin ingin mengkonfirmasi pembayaran donasi terpilih?', 'success')">Konfirmasi
                                Bayar</button>
                        @endif
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
                    @foreach ($donation->campaign->category_campaign as $item)
                        <li>{{ $item->name }}</li>
                    @endforeach
                </ul>
            </x-card>

            <x-card>
                <x-slot name="header">
                    <h5 class="card-title">Gambar Unggulan</h5>
                </x-slot>

                @if (!empty($donation->campaign->path_image))
                    <img src="{{ url(env('PATH_IMAGE_STORAGE') . $donation->campaign->path_image) }}" alt=""
                        class="img-thumbnail">
                @else
                    <img src="{{ url(env('NO_IMAGE_SQUARE')) }}" alt="" class="img-thumbnail">
                @endif
            </x-card>
        </div>
    </div>

    <x-form-modal size="modal-md">
        <x-slot name="title">Form Konfirmasi</x-slot>

        @method('put')

        <input type="hidden" name="status">

        <div class="mt-3 alert">
            <i class="mr-1 fas fa-info-circle"></i> <span class="text-message"></span>
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Ya</button>
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

        function editForm(url, status, message, color) {
            $(modal).modal('show');
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('put');

            $(`${modal} [name=status]`).val(status);
            $(`${modal} .text-message`).html(message);
            $(`${modal} .alert`).removeClass('alert-success alert-danger').addClass(`alert-${color}`);
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

                    let color = '';

                    if (response.data.status == 'confirmed') color = 'success';
                    else if (response.data.status == 'canceled') color = 'error';

                    $('td span.badge').removeAttr('class').attr('class', `badge badge-${color}`);
                    $('.card-footer').remove();
                })
                .fail(errors => {
                    showAlert(errors.responseJSON.message, 'error');
                });
        }
    </script>
@endpush
