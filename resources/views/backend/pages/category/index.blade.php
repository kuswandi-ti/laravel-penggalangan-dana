@extends('backend.layouts.app')

@section('title', 'List Data Kategori')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Kategori</h3>
                    <div class="card-tools">
                        <a href="{{ route('backend.category.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Kategori
                        </a>
                    </div>
                </x-slot>

                <form class="mb-3 d-flex justify-content-between">
                    <x-per-page-table />
                    <x-filter-table />
                </form>

                <x-table>
                    <x-slot name="thead">
                        <th width="5%" style="text-align:center;">No</th>
                        <th>Nama</th>
                        <th width="25%" style="text-align:center;">Jumlah Projek</th>
                        <th width="15%" style="text-align:center;"><i class="fas fa-cog"></i></th>
                    </x-slot>

                    @if ($categories->count())
                        @foreach ($categories as $key => $category)
                            <tr>
                                {{-- https://indocoder.com/tips-trick-laravel/laravel-7-penomoran-baris-pada-laravel-pagination/ --}}
                                {{-- <td style="text-align:center;">{{ $key + $categories->firstItem() }}</td> --}}
                                <td style="text-align:center;">
                                    <x-row-number-table :key="$key" :model="$categories" />
                                </td>
                                <td>{{ $category->name }}</td>
                                <td style="text-align:center;">0</td>
                                <td style="text-align:center;">
                                    <form action="{{ route('backend.category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('backend.category.edit', $category->id) }}"
                                            class="btn btn-link text-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-link text-danger"
                                            onclick="return confirm('Yakin akan menghapus data ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-danger">Tidak ada data</td>
                        </tr>
                    @endif
                </x-table>

                <x-pagination-table :model="$categories" />
            </x-card>
        </div>
    </div>
@endsection

<x-swal />
