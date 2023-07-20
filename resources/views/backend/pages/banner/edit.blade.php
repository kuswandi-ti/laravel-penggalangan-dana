@extends('backend.layouts.app')

@section('title', 'Banner')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.banner.index') }}">List Data Banner</a></li>
    <li class="breadcrumb-item active">Edit Data Banner</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('backend.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-card>
                    <div class="form-group">
                        <label for="banner_title">Judul Banner <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('banner_title') is-invalid @enderror"
                            name="banner_title" id="banner_title" placeholder="Masukkan Judul Banner"
                            value="{{ old('banner_title') ?? $banner->banner_title }}" required>
                        @error('banner_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="banner_description">Deskripsi Banner <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('banner_description') is-invalid @enderror"
                            name="banner_description" id="banner_description" placeholder="Masukkan Deskripsi Banner"
                            value="{{ old('banner_description') ?? $banner->banner_description }}" required>
                        @error('banner_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="banner_image">Image Banner</label>
                        <div class="mb-3 text-center">
                            @if (!empty($banner->banner_image))
                                <img class="img-fluid preview-banner_image"
                                    src="{{ url(env('PATH_IMAGE_STORAGE') . $banner->banner_image) }}" width="500">
                            @else
                                <img class="img-fluid preview-banner_image" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                                    width="500">
                            @endif
                        </div>
                        <div class="mb-3 custom-file">
                            <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                                onchange="preview('.preview-banner_image', this.files[0])">
                            <label class="custom-file-label" for="banner_image">Choose file</label>
                        </div>
                    </div>
                    <x-slot name="footer">
                        <a href="{{ route('backend.banner.index') }}" class="btn btn-default">
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
