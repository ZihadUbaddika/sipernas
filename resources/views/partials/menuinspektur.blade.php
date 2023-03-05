<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.inspektur.home') }}" class="brand-link">
        <img src="{{ asset('assets/img/logo-lampung.png') }}" alt="dashboardLTE Logo" class="brand-image">
        <span class="brand-text font-weight-bold">{{ trans('global.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.inspektur.home') }}"
                        class="nav-link {{ request()->is('dashboard') || request()->is('dashboard/inspektur') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt">

                        </i>
                        <p>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.inspektur.pengajuans.index') }}"
                        class="nav-link {{ request()->is('dashboard/inspektur/pengajuans') || request()->is('dashboard/inspektur/pengajuans/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list">

                        </i>
                        <p>
                            <span>{{ trans('id.pengajuan.judul_singular') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.inspektur.spts.index') }}"
                        class="nav-link {{ request()->is('dashboard/inspektur/spts') || request()->is('dashboard/inspektur/spts/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list">
                        </i>
                        <p>
                            <span>{{ trans('id.pengajuan.spt_singular') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.inspektur.programkegiatans.index') }}"
                        class="nav-link {{ request()->is('dashboard/inspektur/programkegiatans') || request()->is('dashboard/inspektur/programkegiatans/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list">
                        </i>
                        <p>
                            <span>{{ trans('id.pengajuan.programkegiatan_singular') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.inspektur.riwayatkegiatans.index') }}"
                        class="nav-link {{ request()->is('dashboard/inspektur/riwayatkegiatans') || request()->is('dashboard/inspektur/riwayatkegiatans/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list">
                        </i>
                        <p>
                            <span>{{ trans('id.pengajuan.riwayatkegiatan_singular') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
