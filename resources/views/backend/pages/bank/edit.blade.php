@extends('backend.layouts.app')

@section('title', 'Bank')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.bank.index') }}"></a> List Data Bank</li>
    <li class="breadcrumb-item active">Edit Data Bank</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('backend.bank.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-card>
                    <x-slot name="header">
                        <h3 class="card-title">Edit Data Bank</h3>
                    </x-slot>
                    <div class="form-group">
                        <label for="code">Kode Bank</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            id="code" placeholder="Masukkan kode bank" value="{{ old('code') ?? $bank->code }}"
                            required>
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Bank</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Masukkan nama kategori" value="{{ old('name') ?? $bank->name }}"
                            required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Image</label>
                        <div class="mb-3 text-center">
                            @if (!empty($bank->path_image))
                                <img class="img-fluid preview-path_image"
                                    src="{{ url(env('PATH_IMAGE_STORAGE') . $bank->path_image) }}" width="200">
                            @else
                                <img class="img-fluid preview-path_image" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                                    width="200">
                            @endif
                        </div>
                        <div class="mb-3 custom-file">
                            <input type="file" class="custom-file-input" id="path_image" name="path_image"
                                onchange="preview('.preview-path_image', this.files[0])">
                            <label class="custom-file-label" for="path_image">Choose file</label>
                        </div>
                    </div>
                    <x-slot name="footer">
                        <a href="/bank" class="btn btn-warning">
                            <i class="fas fa-chevron-circle-left"></i> Kembali
                        </a>
                        <button type="reset" class="btn btn-dark">
                            <i class="fas fa-ban"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </x-slot>
                </x-card>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
