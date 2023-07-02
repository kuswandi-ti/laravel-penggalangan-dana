@extends('backend.layouts.app')

@section('title', 'Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">List Data Kategori</a></li>
    <li class="breadcrumb-item active">Tambah Data Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <x-card>
                    <x-slot name="header">
                        <h3 class="card-title">Tambah Data Kategori</h3>
                    </x-slot>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Masukkan nama kategori" value='{{ old('name') }}' required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <x-slot name="footer">
                        <a href="/category" class="btn btn-default">
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
