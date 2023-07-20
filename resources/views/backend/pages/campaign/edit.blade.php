@extends('backend.layouts.app')

@section('title', 'Program')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.campaign.index') }}">List Data Program</a></li>
    <li class="breadcrumb-item active">Edit Data Program</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('backend.campaign.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-alert-message />
                <x-card>
                    <x-slot name="header">
                        <h3 class="card-title">Edit Data Program</h3>
                    </x-slot>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" value="{{ old('title') ?? $campaign->title }}"
                                    placeholder="Masukkan Judul Program">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="categories[]">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('categories') is-invalid @enderror"
                                    name="categories[]" id="categories" multiple>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $key }}"
                                            @foreach ($campaign->category_campaign as $r)
                                                {{ $r->id == $key ? 'selected' : ' ' }} @endforeach>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categories')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="short_description">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                    id="short_description" rows="3" placeholder="Isikan Deskripsi Singkat Program">{{ old('short_description') ?? $campaign->short_description }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="body">Content / Body <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote @error('body') is-invalid @enderror" name="body" id="body"
                                    rows="3">{{ old('body') ?? $campaign->body }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="publish_date">Tanggal Publish <span class="text-danger">*</span></label>
                                <div class="input-group datetimepicker" id="publish_date" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('publish_date') is-invalid @enderror"
                                        name="publish_date" id="publish_date"
                                        value="{{ old('publish_date') ?? $campaign->publish_date }}"
                                        data-target="#publish_date" placeholder="Pilih Tanggal Publish">
                                    <div class="input-group-append" data-target="#publish_date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('publish_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="custom-select @error('status') is-invalid @enderror" name="status"
                                    id="status" style="width: 100%;">
                                    <option disabled selected>Pilih Status...</option>
                                    <option value="publish" {{ $campaign->status == 'publish' ? 'selected' : '' }}>Publish
                                    </option>
                                    <option value="pending" {{ $campaign->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="archieve" {{ $campaign->status == 'archieve' ? 'selected' : '' }}>
                                        Diarsipkan
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="goal">Goal <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('goal') is-invalid @enderror"
                                    name="goal" id="goal" value="{{ old('goal') ?? $campaign->goal }}"
                                    placeholder="Masukkan Nominal Goal">
                                @error('goal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">Tanggal Selesai <span class="text-danger">*</span></label>
                                <div class="input-group datetimepicker" id="end_date" data-target-input="nearest">
                                    <input type="text" name="end_date" id="end_date"
                                        value="{{ old('end_date') ?? $campaign->end_date }}"
                                        class="form-control datetimepicker-input @error('end_date') is-invalid @enderror"
                                        data-target="#end_date" placeholder="Pilih Tanggal Selesai">
                                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" name="note" id="note" rows="3" placeholder="Isikan Catatan Program">{{ old('note') ?? $campaign->note }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="receiver">Penerima <span class="text-danger">*</span></label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('receiver') is-invalid @enderror"
                                        type="radio" name="receiver" id="saya" value="Saya Sendiri"
                                        {{ $campaign->receiver == 'Saya Sendiri' ? 'checked' : '' }}>
                                    <label for="saya" class="custom-control-label font-weight-normal">Saya
                                        Sendiri</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('receiver') is-invalid @enderror"
                                        type="radio" name="receiver" id="keluarga" value="Keluarga / Kerabat"
                                        {{ $campaign->receiver == 'Keluarga / Kerabat' ? 'checked' : '' }}>
                                    <label for="keluarga" class="custom-control-label font-weight-normal">Keluarga /
                                        Kerabat</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('receiver') is-invalid @enderror"
                                        type="radio" name="receiver" id="organisasi" value="Organisasi / Lembaga"
                                        {{ $campaign->receiver == 'Organisasi / Lembaga' ? 'checked' : '' }}>
                                    <label for="organisasi" class="custom-control-label font-weight-normal">Organisasi /
                                        Lembaga</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input @error('receiver') is-invalid @enderror"
                                        type="radio" name="receiver" id="lainnya" value="Lainnya"
                                        {{ $campaign->receiver == 'Lainnya' ? 'checked' : '' }}>
                                    <label for="lainnya" class="custom-control-label font-weight-normal">Lainnya</label>
                                </div>
                                @error('receiver')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="path_image">Gambar <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" name="path_image" id="path_image"
                                        class="custom-file-input @error('path_image') is-invalid @enderror"
                                        onchange="preview('.preview-path_image', this.files[0])">
                                    <label class="custom-file-label" for="path_image">Choose file</label>
                                    @error('path_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @if (!empty($campaign->path_image))
                                <img class="img-fluid preview-path_image"
                                    src="{{ url(env('PATH_IMAGE_STORAGE') . $campaign->path_image) }}">
                            @else
                                <img class="img-fluid preview-path_image" src="{{ url(env('NO_IMAGE_SQUARE')) }}">
                            @endif
                        </div>
                    </div>

                    <x-slot name="footer">
                        <a href="{{ route('backend.campaign.index') }}" class="btn btn-default">
                            <i class="fas fa-chevron-circle-left"></i> Kembali
                        </a>
                        <button type="reset" class="btn btn-warning">
                            <i class="fas fa-ban"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </x-slot>

                </x-card>
            </form>
        </div>
    </div>
@endsection

<x-swal />

@includeIf('includes.datatable')
@includeIf('includes.summernote')
@includeIf('includes.select2')
@includeIf('includes.datepicker')
