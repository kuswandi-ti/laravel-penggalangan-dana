@extends('layouts.app')

@section('title', 'Setting')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Setting</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <h3 class="card-title">Edit Setting</h3>
                </x-slot>

                <div class="row">
                    <div class="col-4 col-sm-2">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link @if (request('tab') == '') active @endif"
                                href="{{ route('setting.index') }}">
                                <i class="nav-icon fas fa-list-alt"></i> General
                            </a>
                            <a class="nav-link @if (request('tab') == 'logo') active @endif"
                                href="{{ route('setting.index') }}?tab=logo">
                                <i class="nav-icon fas fa-images"></i> Logo
                            </a>
                            <a class="nav-link @if (request('tab') == 'social_media') active @endif"
                                href="{{ route('setting.index') }}?tab=social_media">
                                <i class="nav-icon fas fa-share-alt"></i> Social Media
                            </a>
                        </div>
                    </div>
                    <div class="col-8 col-sm-10">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="text-left tab-pane fade @if (request('tab') == '') show active @endif">
                                <form action="{{ route('setting.update', !empty($setting->id) ? $setting->id : '') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @includeIf('setting.general')
                                </form>
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'logo') show active @endif">
                                <form
                                    action="{{ route('setting.update', !empty($setting->id) ? $setting->id : '') }}?tab=logo"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @includeIf('setting.logo')
                                </form>
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'social_media') show active @endif">
                                <form
                                    action="{{ route('setting.update', !empty($setting->id) ? $setting->id : '') }}?tab=social_media"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @includeIf('setting.social_media')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
