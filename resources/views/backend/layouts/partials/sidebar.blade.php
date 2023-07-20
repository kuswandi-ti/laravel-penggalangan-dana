<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{ route('backend.dashboard') }}" class="brand-link bg-dark">
        <img src="{{ url(env('PATH_IMAGE_STORAGE') . (!empty($setting->path_image_logo) ? $setting->path_image_logo : '')) ?? '' }}"
            alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
        <span
            class="brand-text font-weight-light">{{ !empty($setting->business_name) ? $setting->business_name : config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
            <div class="image">
                <img src="{{ url(env('PATH_IMAGE_STORAGE') . auth()->user()->path_image ?? '') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('backend.profile.show') }}?tab=profil" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('backend.dashboard') }}"
                        class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="{{ route('backend.bank.index') }}"
                            class="nav-link {{ request()->is('admin/bank*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Bank
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.category.index') }}"
                            class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cube"></i>
                            <p>
                                Kategori
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.campaign.index') }}"
                            class="nav-link {{ request()->is('admin/campaign*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>
                                Program
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">REFERENSI</li>
                    <li class="nav-item">
                        <a href="{{ route('backend.donatur.index') }}"
                            class="nav-link {{ request()->is('admin/donatur*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Donatur
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.donation.index') }}"
                            class="nav-link {{ request()->is('admin/donation*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-donate"></i>
                            <p>
                                Daftar Donasi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.cashout.index') }}"
                            class="nav-link {{ request()->is('admin/cashout*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-donate"></i>
                            <p>
                                Daftar Pencairan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.contact.index') }}"
                            class="nav-link {{ request()->is('admin/contact*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Kontak Masuk
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.subscriber.index') }}"
                            class="nav-link {{ request()->is('admin/subscriber*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Subscriber
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">REPORT</li>
                    <li class="nav-item">
                        <a href="{{ route('backend.report.index') }}"
                            class="nav-link {{ request()->is('admin/report*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Laporan
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">LOG</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            Log Aktifitas
                        </p>
                    </a>
                </li>

                @if (auth()->user()->hasRole('admin'))
                    <li class="nav-header">PENGATURAN</li>
                    <li class="nav-item">
                        <a href="{{ route('backend.banner.index') }}"
                            class="nav-link {{ request()->is('admin/banner*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-flag"></i>
                            <p>
                                Banner
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.setting.index') }}"
                            class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
