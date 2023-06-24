@extends('layouts.app')

@section('title', 'Profil')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Data Profil</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">Edit Data Profil</h3>
                </x-slot>

                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link @if (request('tab') != 'password') active @endif"
                                href="{{ route('profile.show') }}">
                                Profil
                            </a>
                            <a class="nav-link @if (request('tab') == 'password') active @endif"
                                href="{{ route('profile.show') }}?tab=password">
                                Password
                            </a>
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="text-left tab-pane fade @if (request('tab') != 'password') show active @endif">
                                <form action="{{ route('user-profile-information.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @includeIf('profile.update-profile-information-form')
                                </form>
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'password') show active @endif">
                                <form action="{{ route('user-password.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @includeIf('profile.update-password-form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
