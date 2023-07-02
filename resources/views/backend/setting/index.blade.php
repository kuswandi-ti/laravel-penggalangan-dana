@extends('backend.layouts.app')

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
                            <a class="nav-link @if (request('tab') == 'image') active @endif"
                                href="{{ route('setting.index') }}?tab=image">
                                <i class="nav-icon fas fa-images"></i> Image
                            </a>
                            <a class="nav-link @if (request('tab') == 'social_media') active @endif"
                                href="{{ route('setting.index') }}?tab=social_media">
                                <i class="nav-icon fas fa-share-alt"></i> Social Media
                            </a>
                            <a class="nav-link @if (request('tab') == 'bank') active @endif"
                                href="{{ route('setting.index') }}?tab=bank">
                                <i class="nav-icon fas fa-university"></i> Bank
                            </a>
                            <a class="nav-link @if (request('tab') == 'banner') active @endif"
                                href="{{ route('setting.index') }}?tab=banner">
                                <i class="nav-icon fas fa-flag"></i> Banner
                            </a>
                        </div>
                    </div>
                    <div class="col-8 col-sm-10">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="text-left tab-pane fade @if (request('tab') == '') show active @endif">
                                @includeIf('backend.setting.general')
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'image') show active @endif">
                                @includeIf('backend.setting.image')
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'social_media') show active @endif">
                                @includeIf('backend.setting.social_media')
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'bank') show active @endif">
                                @includeIf('backend.setting.bank')
                            </div>
                            <div class="tab-pane fade @if (request('tab') == 'banner') show active @endif">
                                @includeIf('backend.setting.banner')
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
