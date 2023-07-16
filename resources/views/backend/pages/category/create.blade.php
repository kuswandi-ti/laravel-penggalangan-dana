@extends('backend.layouts.app')

@section('title', 'Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">List Data Kategori</a></li>
    <li class="breadcrumb-item active">Tambah Data Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('backend.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-alert-message />
                <x-card>
                    <x-slot name="header">
                        <h3 class="card-title">Tambah Data Kategori</h3>
                    </x-slot>
                    <div class="form-group">
                        <label for="name">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Masukkan nama kategori" value='{{ old('name') }}'>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="path_image">Gambar Kategori</label>
                        <div class="mb-3 text-center">
                            @if (!empty($category->path_image))
                                <img class="img-fluid preview-path_image"
                                    src="{{ url(env('PATH_IMAGE_STORAGE') . $category->path_image) }}" width="200">
                            @else
                                <img class="img-fluid preview-path_image" src="{{ url(env('NO_IMAGE_CIRCLE')) }}"
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
                        <a href="{{ route('backend.category.index') }}" class="btn btn-default">
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
