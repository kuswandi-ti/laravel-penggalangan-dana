@extends('backend.layouts.app')

@section('title', 'Bank')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">List Data Bank</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">List Data Bank</h3>
                    <div class="card-tools">
                        <a href="{{ route('backend.bank.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Data Bank
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
                        <th width="25%" style="text-align:center;">Kode Bank</th>
                        <th>Nama Bank</th>
                        <th width="15%" style="text-align:center;"><i class="fas fa-cog"></i></th>
                    </x-slot>

                    @if ($banks->count())
                        @foreach ($banks as $key => $bank)
                            <tr>
                                <td style="text-align:center;">
                                    <x-row-number-table :key="$key" :model="$banks" />
                                </td>
                                <td style="text-align:center;">{{ $bank->code }}</td>
                                <td>{{ $bank->name }}</td>
                                <td style="text-align:center;">
                                    <form action="{{ route('backend.bank.destroy', $bank->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('backend.bank.edit', $bank->id) }}"
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

                <x-pagination-table :model="$banks" />
            </x-card>
        </div>
    </div>
@endsection

<x-swal />
