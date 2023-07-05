@extends('backend.layouts.app')

@section('title', 'Banner')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Banner</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Banner</h3>
                    <div class="card-tools">
                        <a href="{{ route('banner.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Banner
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
                        <th width="25%">Judul Banner</th>
                        <th>Deskripsi Banner</th>
                        <th width="15%" style="text-align:center;"><i class="fas fa-cog"></i></th>
                    </x-slot>

                    @if ($banners->count())
                        @foreach ($banners as $key => $banner)
                            <tr>
                                <td style="text-align:center;">
                                    <x-row-number-table :key="$key" :model="$banners" />
                                </td>
                                <td>{{ $banner->banner_title }}</td>
                                <td>{{ $banner->banner_description }}</td>
                                <td style="text-align:center;">
                                    <form action="{{ route('banner.destroy', $banner->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-link text-primary">
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

                <x-pagination-table :model="$banners" />
            </x-card>
        </div>
    </div>
@endsection

<x-swal />
