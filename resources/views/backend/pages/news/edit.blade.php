@extends('backend.layouts.app')

@section('title', 'Berita')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('backend.news.index') }}">List Data Berita</a></li>
    <li class="breadcrumb-item active">Edit Data Berita</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('backend.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-card>
                    <x-slot name="header">
                        <h3 class="card-title">Edit Data Berita</h3>
                    </x-slot>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" value="{{ old('title') ?? $news->title }}"
                                    placeholder="Masukkan Judul Berita">
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
                                <label for="body">Konten / Body <span class="text-danger">*</span></label>
                                <textarea class="form-control summernote @error('body') is-invalid @enderror" name="body" id="body"
                                    rows="5">{{ old('body') ?? $news->body }}</textarea>
                                @error('body')
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
                            @if ($news->count() == 0)
                                <img class="img-fluid preview-path_image" src="{{ url(env('NO_IMAGE_SQUARE')) }}">
                            @else
                                @if (!empty($news->path_image))
                                    <img class="img-fluid preview-path_image"
                                        src="{{ url(env('PATH_IMAGE_STORAGE') . $news->path_image) }}">
                                @else
                                    <img class="img-fluid preview-path_image" src="{{ url(env('NO_IMAGE_SQUARE')) }}">
                                @endif
                            @endif
                        </div>
                    </div>

                    <x-slot name="footer">
                        <a href="{{ route('backend.news.index') }}" class="btn btn-default">
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
@includeIf('includes.select2', ['placeholder' => 'Pilih Kategori'])
@includeIf('includes.datepicker')
